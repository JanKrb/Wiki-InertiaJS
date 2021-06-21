<?php

use App\Http\Controllers\API\AnnouncementController;
use App\Http\Controllers\API\EnvironmentController;
use App\Http\Controllers\API\Post\PostCommentController;
use App\Http\Controllers\API\Post\PostController;
use App\Http\Controllers\API\User\AuthController;
use App\Http\Controllers\API\User\BadgeController;
use App\Http\Controllers\API\User\BanController;
use App\Http\Controllers\API\User\UserBadgesController;
use App\Http\Controllers\API\User\UserBansController;
use App\Http\Controllers\API\User\UserMgmtController;
use App\Http\Controllers\API\Post\CategoryController;
use App\Http\Controllers\API\Permission\PermissionController;
use App\Http\Controllers\API\Permission\RoleController;
use App\Http\Controllers\API\Permission\RolesPermissionsController;
use App\Http\Controllers\API\Post\TagController;
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
    Route::get('roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware(['permission:roles_get_all'])
    ;

    Route::post('roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware(['permission:roles_store'])
    ;

    Route::put('roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware(['permission:roles_update'])
    ;

    Route::delete('roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware(['permission:roles_destroy'])
    ;

    Route::get('roles/{role}', [RoleController::class, 'show'])
        ->name('roles.show')
        ->middleware(['permission:roles_get_single'])
    ;

    Route::get('permissions', [PermissionController::class, 'index'])
        ->name('permissions.index')
        ->middleware(['permission:permissions_get_all'])
    ;

    Route::post('permissions', [PermissionController::class, 'store'])
        ->name('permissions.store')
        ->middleware(['permission:permissions_store'])
    ;

    Route::put('permissions/{permission}', [PermissionController::class, 'update'])
        ->name('permissions.update')
        ->middleware(['permission:permissions_update'])
    ;

    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])
        ->name('permissions.destroy')
        ->middleware(['permission:permissions_destroy'])
    ;

    Route::get('permissions/{permission}', [PermissionController::class, 'show'])
        ->name('permissions.show')
        ->middleware(['permission:permissions_get_single'])
    ;

    Route::get('roles/{role}/permissions', [RolesPermissionsController::class, 'index'])
        ->name('roles.permissions.index')
        ->middleware(['permission:roles_permissions_get_all'])
    ;

    Route::post('roles/{role}/permissions', [RolesPermissionsController::class, 'store'])
        ->name('roles.permissions.store')
        ->middleware(['permission:roles_permissions_store'])
    ;

    Route::get('roles/{role}/permissions/{permission}', [RolesPermissionsController::class, 'show'])
        ->name('roles.permissions.show')
        ->middleware(['permission:roles_permissions_get_single'])
    ;

    Route::get('roles/{role}/permissions/{permission_name}/name', [RolesPermissionsController::class, 'show_name'])
        ->name('roles.permissions.showName')
        ->middleware(['permission:roles_permissions_get_single_name'])
    ;

    Route::delete('roles/{role}/permissions/{permission}', [RolesPermissionsController::class, 'destroy'])
        ->name('roles.permissions.destroy')
        ->middleware(['permission:roles_permissions_destroy'])
    ;
});

// Badges System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('badges', [BadgeController::class, 'index'])
        ->name('badges.index')
        ->middleware(['permission:badges_get_all'])
    ;

    Route::post('badges', [BadgeController::class, 'store'])
        ->name('badges.store')
        ->middleware(['permission:badges_store'])
    ;

    Route::put('badges/{badge}', [BadgeController::class, 'update'])
        ->name('badges.update')
        ->middleware(['permission:badges_update'])
    ;

    Route::delete('badges/{badge}', [BadgeController::class, 'destroy'])
        ->name('badges.destroy')
        ->middleware(['permission:badges_destroy'])
    ;

    Route::get('badges/{badge}', [BadgeController::class, 'show'])
        ->name('badges.show')
        ->middleware(['permission:badges_get_single'])
    ;

    Route::get('users/{user}/badges', [UserBadgesController::class, 'index'])
        ->name('users.badges.index')
        ->middleware(['permission:user_badges_get_all'])
    ;

    Route::post('users/{user}/badges/multiple', [UserBadgesController::class, 'storeArray'])
        ->name('users.badges.store_array')
        ->middleware(['permission:user_badges_store_array'])
    ;

    Route::post('users/{user}/badges', [UserBadgesController::class, 'store'])
        ->name('users.badges.store')
        ->middleware(['permission:user_badges_store'])
    ;

    Route::get('users/{user}/badges/{badge}', [UserBadgesController::class, 'show'])
        ->name('users.badges.show')
        ->middleware(['permission:user_badges_get_single'])
    ;

    Route::delete('users/{user}/badges/multiple', [UserBadgesController::class, 'destroyArray'])
        ->name('users.badges.destroy_array')
        ->middleware(['permission:user_badges_destroy_array'])
    ;

    Route::delete('users/{user}/badges/{badge}', [UserBadgesController::class, 'destroy'])
        ->name('users.badges.destroy')
        ->middleware(['permission:user_badges_destroy'])
    ;
});

// Categories System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('categories', [CategoryController::class, 'index'])
        ->name('categories.index')
        ->middleware(['permission:categories_get_all'])
    ;

    Route::get('categories/structured', [CategoryController::class, 'structured'])
        ->name('categories.structured')
        ->middleware(['permission:categories_get_structured'])
    ;

    Route::post('categories', [CategoryController::class, 'store'])
        ->name('categories.store')
        ->middleware(['permission:categories_store'])
    ;

    Route::put('categories/{category}', [CategoryController::class, 'update'])
        ->name('categories.update')
        ->middleware(['permission:categories_update'])
    ;

    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy')
        ->middleware(['permission:categories_destroy'])
    ;

    Route::get('categories/{category}', [CategoryController::class, 'show'])
        ->name('categories.show')
        ->middleware(['permission:categories_get_single'])
    ;
});

// Tags System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('tags', [TagController::class, 'index'])
        ->name('tags.index')
        ->middleware(['permission:tags_get_all'])
    ;

    Route::post('tags', [TagController::class, 'store'])
        ->name('tags.store')
        ->middleware(['permission:tags_store'])
    ;

    Route::put('tags/{tag}', [TagController::class, 'update'])
        ->name('tags.update')
        ->middleware(['permission:tags_update'])
    ;

    Route::delete('tags/{tag}', [TagController::class, 'destroy'])
        ->name('tags.destroy')
        ->middleware(['permission:tags_destroy'])
    ;

    Route::get('tags/{tag}', [TagController::class, 'show'])
        ->name('tags.show')
        ->middleware(['permission:tags_get_single'])
    ;
});

// User Management System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users', [UserMgmtController::class, 'index'])
        ->name('users.index')
        ->middleware(['permission:users_get_all'])
    ;

    Route::get('users/{user}', [UserMgmtController::class, 'show'])
        ->name('users.show')
        ->middleware(['permission:users_get_single'])
    ;

    Route::put('users/{user}', [UserMgmtController::class, 'update'])
        ->name('users.update')
        ->middleware(['permission:users_update'])
    ;

    Route::post('users/{user}/reset_password', [UserMgmtController::class, 'sendPasswordResetNotification'])
        ->name('users.reset_password')
        ->middleware(['permission:users_reset_password'])
    ;

    Route::post('users/{user}/verify_email', [UserMgmtController::class, 'sendEmailVerificationNotification'])
        ->name('users.verify_email')
        ->middleware(['permission:users_verify_email'])
    ;

    Route::post('users/{user}/change_password', [UserMgmtController::class, 'changePassword'])
        ->name('users.change_password')
        ->middleware(['permission:users_change_password'])
    ;

    Route::post('users/{user}/delete', [UserMgmtController::class, 'delete'])
        ->name('users.delete')
        ->middleware(['permission:users_delete'])
    ;
});

// Ban System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('bans', [BanController::class, 'index'])
        ->name('bans.index')
        ->middleware(['permission:bans_get_all'])
    ;

    Route::post('bans', [BanController::class, 'store'])
        ->name('bans.store')
        ->middleware(['permission:bans_store'])
    ;

    Route::get('bans/count', [BanController::class, 'count_bans'])
        ->name('bans.count')
        ->middleware(['permission:bans_count'])
    ;

    Route::put('bans/{ban}', [BanController::class, 'update'])
        ->name('bans.update')
        ->middleware(['permission:bans_update'])
    ;

    Route::delete('bans/{ban}', [BanController::class, 'destroy'])
        ->name('bans.destroy')
        ->middleware(['permission:bans_destroy'])
    ;

    Route::get('bans/{ban}', [BanController::class, 'show'])
        ->name('bans.show')
        ->middleware(['permission:bans_get_single'])
    ;

    Route::get('users/{user}/bans', [UserBansController::class, 'index'])
        ->name('users.bans.index')
        ->middleware(['permission:user_bans_get_all'])
    ;

    Route::post('users/{user}/bans', [UserBansController::class, 'store'])
        ->name('users.bans.store')
        ->middleware(['permission:user_bans_store'])
    ;

    Route::get('users/{user}/bans/count', [UserBansController::class, 'count_bans'])
        ->name('users.bans.count')
        ->middleware(['permission:user_bans_count'])
    ;

    Route::get('users/{user}/bans/{ban}', [UserBansController::class, 'show'])
        ->name('users.bans.show')
        ->middleware(['permission:user_bans_get_single'])
    ;

    Route::delete('users/{user}/bans/{ban}', [UserBansController::class, 'destroy'])
        ->name('users.bans.destroy')
        ->middleware(['permission:user_bans_destroy'])
    ;
});

// Posts System
Route::group(['middleware' => 'auth:api'], function() {
    // History
    Route::get('posts/histories', [PostController::class, 'history'])
        ->name('posts_history.get_all')
        ->middleware(['permission:posts_history_get_all'])
    ;

    Route::get('posts/{post}/histories', [PostController::class, 'post_history'])
        ->name('posts.histories')
        ->middleware(['permission:posts_history_get_post'])
    ;

    Route::get('posts/histories/{history}', [PostController::class, 'history_show'])
        ->name('posts.history')
        ->middleware(['permission:posts_history_get_single'])
    ;

    // Comments
    Route::get('posts/comments', [PostCommentController::class, 'index'])
        ->name('posts_comments.get_all')
        ->middleware(['permission:posts_comments_get_all'])
    ;

    Route::get('posts/{post}/comments', [PostCommentController::class, 'post_comments'])
        ->name('posts.comments')
        ->middleware(['permission:posts_comments_get_post'])
    ;

    Route::get('posts/comments/{comment}', [PostCommentController::class, 'show'])
        ->name('posts.comment')
        ->middleware(['permission:posts_comments_get_single'])
    ;

    Route::post('posts/{post}/comments', [PostCommentController::class, 'store'])
        ->name('posts.comment.store')
        ->middleware(['permission:posts_comments_store'])
    ;

    Route::put('posts/comments/{comment}', [PostCommentController::class, 'update'])
        ->name('posts.comment.update')
        ->middleware(['permission:posts_comments_update'])
    ;

    Route::delete('posts/comments/{comment}', [PostCommentController::class, 'destroy'])
        ->name('posts.comment.destroy')
        ->middleware(['permission:posts_comments_destroy'])
    ;

    // Posts
    Route::get('posts', [PostController::class, 'index'])
        ->name('posts.index')
        ->middleware(['permission:posts_get_all'])
    ;

    Route::get('posts/recent', [PostController::class, 'recent_posts'])
        ->name('posts.recent')
        ->middleware(['permission:posts_recent'])
    ;

    Route::get('posts/{post}', [PostController::class, 'show'])
        ->name('posts.show')
        ->middleware(['permission:posts_get_single'])
    ;

    Route::post('posts', [PostController::class, 'store'])
        ->name('posts.store')
        ->middleware(['permission:posts_store'])
    ;

    Route::put('posts/{post}', [PostController::class, 'update'])
        ->name('posts.update')
    ;

    Route::delete('posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.destroy')
        ->middleware(['permission:posts_destroy'])
    ;
});

// Announcement System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('announcements', [AnnouncementController::class, 'index'])
        ->name('announcements.index')
        ->middleware(['permission:announcements_get_all'])
    ;

    Route::post('announcements', [AnnouncementController::class, 'store'])
        ->name('announcements.store')
        ->middleware(['permission:announcements_store'])
    ;

    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])
        ->name('announcements.update')
        ->middleware(['permission:announcements_update'])
    ;

    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])
        ->name('announcements.destroy')
        ->middleware(['permission:announcements_destroy'])
    ;

    Route::get('announcements/{announcement}', [announcementController::class, 'show'])
        ->name('announcements.show')
        ->middleware(['permission:announcements_get_single'])
    ;
});

// Environment System
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('environment/mysql', [EnvironmentController::class, 'update_mysql'])
        ->name('environment.update_mysql')
        ->middleware(['permission:environment_update_mysql'])
    ;

    Route::post('environment/mail', [EnvironmentController::class, 'update_mail'])
        ->name('environment.update_mail')
        ->middleware(['permission:environment_update_mail'])
    ;
});
