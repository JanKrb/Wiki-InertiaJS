<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RolesPermissionsController;
use App\Http\Controllers\API\UserController;
use Orion\Facades\Orion;
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

Route::get('/', function () {
    return response([
        'success' => false,
        'message' => 'Please use the api routes to communicate with the backend.'
    ], 404)->header('Content-Type', 'application/json');
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('password/recover', [AuthController::class, 'recover_password']);
    Route::post('password/reset', [AuthController::class, 'reset_password']);
    Route::post('email/confirm', [AuthController::class, 'confirm_email']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('password/change', [AuthController::class, 'change_password']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    // TODO: Add permission middlewares

    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');

    Route::get('roles/{role}/permissions', [RolesPermissionsController::class, 'index'])->name('roles.permissions.index');
    Route::post('roles/{role}/permissions', [RolesPermissionsController::class, 'store'])->name('roles.permissions.store');
    Route::post('roles/{role}/permissions/attach', [RolesPermissionsController::class, 'attach'])->name('roles.permissions.attach');
    Route::delete('roles/{role}/permissions/detach', [RolesPermissionsController::class, 'detach'])->name('roles.permissions.detach');
    Route::post('roles/{role}/permissions/search', [RolesPermissionsController::class, 'search'])->name('sroles.permissions.earch');
    Route::patch('roles/{role}/permissions/sync', [RolesPermissionsController::class, 'sync'])->name('roles.permissions.sync');
    Route::get('roles/{role}/permissions/toggle', [RolesPermissionsController::class, 'toggle'])->name('roles.permissions.toggle');
    Route::get('roles/{role}/permissions/{permission?}', [RolesPermissionsController::class, 'show'])->name('roles.permissions.show');
    Route::patch('roles/{role}/permissions/{permission?}', [RolesPermissionsController::class, 'update'])->name('roles.permissions.update');
    Route::delete('roles/{role}/permissions/{permission?}', [RolesPermissionsController::class, 'destroy'])->name('roles.permissions.destroy');
    Route::get('roles/{role}/permissions/{permission?}/privot', [RolesPermissionsController::class, 'updatePivot'])->name('roles.permissions.updatePivot');
});

Route::get('middleware_test', ['middleware' => ['auth:api', 'permission:test_permission'], function () {
    $response = [
        'success' => true,
        'data'    => [],
        'message' => "Middleware passed",
    ];

    return response()->json($response, 200);
}]);
