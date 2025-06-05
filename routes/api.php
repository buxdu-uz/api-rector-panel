<?php

use App\Http\Controllers\Faculties\FacultyController;
use App\Http\Controllers\Faculties\FacultyDebtController;
use App\Http\Controllers\Hemis\HemisController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[HemisController::class,'login']);
Route::post('login/hemis',[HemisController::class,'checkHemisAuth'])->middleware('cors');

Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::get('faculties', [FacultyController::class,'getAll']);
    Route::post('logout', [HemisController::class, 'logout']);


    Route::group(['prefix' => 'admin','middleware' => ['role:admin']], function (){
        Route::get('faculty_debts',[FacultyDebtController::class,'paginate']);
        Route::post('faculty_debts',[FacultyDebtController::class,'store']);
        Route::put('faculty_debts/{faculty_debt}',[FacultyDebtController::class,'update']);
    });

});
