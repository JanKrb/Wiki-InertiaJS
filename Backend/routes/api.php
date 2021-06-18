<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RolesPermissionsController;
use App\Http\Controllers\API\UserBadgesController;
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

// Auth System
Route::group(['prefix' => 'auth'], function() {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('password/recover', [AuthController::class, 'recover_password']);
    Route::post('password/reset', [AuthController::class, 'reset_password']);
    Route::post('email/confirm', [AuthController::class, 'confirm_email']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', [AuthController::class, 'user']);
        Route::post('update-details/{account}', [AuthController::class, 'update_details']);
        Route::post('password/change', [AuthController::class, 'change_password']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

// Roles & Permissions System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');

    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');

    Route::get('roles/{role}/permissions', [RolesPermissionsController::class, 'index'])->name('roles.permissions.index');
    Route::post('roles/{role}/permissions', [RolesPermissionsController::class, 'store'])->name('roles.permissions.store');
    Route::get('roles/{role}/permissions/{permission}', [RolesPermissionsController::class, 'show'])->name('roles.permissions.show');
    Route::get('roles/{role}/permissions/{permission_name}/name', [RolesPermissionsController::class, 'show_name'])->name('roles.permissions.showName');
    Route::delete('roles/{role}/permissions/{permission}', [RolesPermissionsController::class, 'destroy'])->name('roles.permissions.destroy');
});

// Badges System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('badges', [CategoryController::class, 'index'])->name('badges.index');
    Route::post('badges', [CategoryController::class, 'store'])->name('badges.store');
    Route::put('badges/{badge}', [CategoryController::class, 'update'])->name('badges.update');
    Route::delete('badges/{badge}', [CategoryController::class, 'destroy'])->name('badges.destroy');
    Route::get('badges/{badge}', [CategoryController::class, 'show'])->name('badges.show');

    Route::get('users/{user}/badges', [UserBadgesController::class, 'index'])->name('users.badges.index');
    Route::post('users/{user}/badges', [UserBadgesController::class, 'store'])->name('users.badges.store');
    Route::get('users/{user}/badges/{badge}', [UserBadgesController::class, 'show'])->name('users.badges.show');
    Route::delete('users/{user}/badges/{badge}', [UserBadgesController::class, 'destroy'])->name('users.badges.destroy');
});

// Categories System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
});

// Debugging
Route::get('middleware_test', ['middleware' => ['auth:api', 'permission:test_permission'], function () {
    $response = [
        'success' => true,
        'data'    => [],
        'message' => "Middleware passed",
    ];

    return response()->json($response, 200);
}]);
