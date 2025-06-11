<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getAllRoles()
    {
        return $this->successResponse(
            'All roles retrieved successfully',
            RoleResource::collection(Role::all()));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id_number' => 'required|numeric|unique:users,employee_id_number',
            'full_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
        ],
            [
                'employee_id_number.required' => 'HemisId yozilishi shart.',
                'employee_id_number.numeric' => 'HemisId raqami raqamli bo`lishi kerak.',
                'employee_id_number.unique' => 'Bu hemis ID raqami allaqachon ishlatilmoqda.',
                'full_name.required' => 'FIO to`ldirilishi shart',
                'role_id.required' => 'Role tanlanishi kerak',
                'role_id.exists' => 'Tanlangan rol mavjud emas.'
            ]);

        try {
            $user = User::create([
                'login' => $request->employee_id_number,
                'password' => $request->employee_id_number,
                'employee_id_number' => $request->employee_id_number,
                'fullname' => $request->full_name
            ]);

            $role = Role::findOrFail($request->role_id);
            $user->assignRole($role->name);

            return $this->successResponse('User created successfully', new UserResource($user));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
