<?php

use App\Http\Controllers\Auth\{AuthController, ChangePasswordController, PasswordResetRequestController};
use App\Http\Controllers\SuperAdmin\{CrudController, DashboardController, UserController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::post('/reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);

Route::post('/change-password', [ChangePasswordController::class, 'passwordResetProcess']);

#Super Admin route
Route::middleware(['api', 'auth'])->group(function () { // a remetre apres integration coté vue et gestion du refresh token
    Route::prefix('superadmin')->group(function () {
        Route::apiResource('user', UserController::class);
        Route::put('user/restore/{user}', [UserController::class, 'restore']);
        Route::get('dashboard', DashboardController::class);
        Route::apiResource('crud', CrudController::class);
        Route::get('student/student-excel', [UserController::class, 'donwloadExcelToSubscripbeStudent']);
    });
});
