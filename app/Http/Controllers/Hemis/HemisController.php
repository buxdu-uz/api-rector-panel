<?php

namespace App\Http\Controllers\Hemis;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\SessionState;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use League\OAuth2\Client\Provider\GenericProvider;

class HemisController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|exists:users,login',
            'password' => 'required',
        ]);

        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            $user = User::where('login', $request->login)->first();

            $token = $user->createToken('token-name', [$user->login])->plainTextToken;
            return $this->successResponse([
                'token' => $token
            ], new UserResource($user));
        }
        return $this->errorResponse('Login or password error', 404);
    }



    //oAuth2
    protected function getProvider(): GenericProvider
    {
        return new GenericProvider([
            'clientId'                => config('hemis.hemis.client_id'),
            'clientSecret'            => config('hemis.hemis.client_secret'),
            'redirectUri'             => config('hemis.hemis.redirect'),
            'urlAuthorize'            => config('hemis.hemis.authorize_url'),
            'urlAccessToken'          => config('hemis.hemis.token_url'),
            'urlResourceOwnerDetails' => config('hemis.hemis.resource_url'),
        ]);
    }

    public function redirectToProvider()
    {
        $provider = $this->getProvider();

        $authUrl = $provider->getAuthorizationUrl();
        Session::put('oauth2state', $provider->getState());

        return redirect($authUrl);
    }

    public function handleCallback(Request $request)
    {
        $provider = $this->getProvider();

        if (!$request->has('code') || $request->get('state') !== Session::get('oauth2state')) {
            Session::forget('oauth2state');
            return redirect('/')->withErrors('Invalid OAuth state');
        }

        try {
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->get('code')
            ]);

            $resourceOwner = $provider->getResourceOwner($accessToken);
            $user = $resourceOwner->toArray();
            Log::info("user: handlecallback",$user);
//            User::updateOrCreate([
//                'employee_id_number' => $user['employee_id_number'],
//            ],[
//                'fullname' => $user['full_name'],
//                'login' => $user['employee_id_number'],
//                'password' => bcrypt($user['employee_id_number'])
//            ]);

            Session::put('user',$user);
            Session::put('state',$request->get('state'));
            Session::put('code',$request->get('code'));

            SessionState::create([
                'state' => $request->get('state'),
                'employee_id_number' => $user['employee_id_number']
            ]);
            Log::info("path", array(config('hemis.front_url') . "/auth/hemis?state=" . $request->get('state')));
            return redirect()->away(config('hemis.front_url') . "/auth/hemis?state=" . $request->get('state'));
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkHemisAuth(Request $request)
    {
        Log::info("state", $request->all());
        $sessionState = SessionState::query()->latest()->first();
        $request->validate([
            'state' => 'required'
        ]);
        // Compare state and code from session
        if ($sessionState->state === $request->state) {
            $employee_id = $sessionState->employee_id_number;
//            Log::info("enmployeeid",$employee_id);
//            if ($employee_id == 3041911001 || $employee_id == 3042311060 || $employee_id == 3042011168 || $employee_id == 3041411007) {
                // Find the user in DB (optional if full object already in session)
                $authUser = User::query()
//                    ->whereIn('employee_id_number', [3041911001,3042311060,3042011168,3041411007])
                    ->where('employee_id_number', $employee_id)
                    ->first();

//                Log::info("auth user",$authUser);

                if ($authUser) {
                    // Log in the user
                    Auth::login($authUser);

                    // Optional: regenerate session for security
                    Session::regenerate();

                    return response()->json([
                        'status' => true,
                        'message' => 'Login successful',
                        'user' => new UserResource($authUser),
                        'token' => $authUser->createToken('API Token')->plainTextToken, // if using Sanctum
                    ]);

                }
//            }else{
//                return response()->json([
//                    'message' => 'Sizning kirishingizga ruxsat mavjud emas!',
//                ], 403);
//            }
        }

        return response()->json([
            'message' => 'Unauthorized or invalid session state/code',
        ], 401);
    }

    public function logout()
    {
        // Get the currently authenticated user for the 'employee' guard
        $user = Auth::user();

        if ($user && $user->currentAccessToken()) {
            // Revoke the current access token
            $user->currentAccessToken()->delete();
        }

        return $this->successResponse('Logged out successfully');
    }
}
