<?php

use App\Http\Controllers\API\AnnouncementController;
use App\Http\Controllers\API\EnvironmentController;
use App\Http\Controllers\API\Post\PostCommentController;
use App\Http\Controllers\API\Post\PostController;
use App\Http\Controllers\API\Post\PostHistoryController;
use App\Http\Controllers\API\Post\PostReportController;
use App\Http\Controllers\API\User\AuthController;
use App\Http\Controllers\API\User\BadgeController;
use App\Http\Controllers\API\User\BanController;
use App\Http\Controllers\API\User\NotificationController;
use App\Http\Controllers\API\User\UserBadgesController;
use App\Http\Controllers\API\User\UserBansController;
use App\Http\Controllers\API\User\UserMgmtController;
use App\Http\Controllers\API\Post\CategoryController;
use App\Http\Controllers\API\Permission\PermissionController;
use App\Http\Controllers\API\Permission\RoleController;
use App\Http\Controllers\API\Permission\RolesPermissionsController;
use App\Http\Controllers\API\Post\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\TestController;
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
    Route::get('roles', [RoleController::class, 'get_all'])
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

    Route::delete('roles/{role}', [RoleController::class, 'delete'])
        ->name('roles.delete')
        ->middleware(['permission:roles_delete'])
    ;

    Route::delete('roles/{role}/force', [RoleController::class, 'force_delete'])
        ->name('roles.force_delete')
        ->middleware(['permission:roles_force_delete'])
    ;

    Route::post('roles/{role}/recover', [RoleController::class, 'recover'])
        ->name('roles.recover')
        ->middleware(['permission:roles_recover'])
    ;

    Route::get('roles/{role}', [RoleController::class, 'get_single'])
        ->name('roles.show')
        ->middleware(['permission:roles_get_single'])
    ;

    Route::get('permissions', [PermissionController::class, 'get_all'])
        ->name('permissions.index')
        ->middleware(['permission:permissions_get_all'])
    ;

    Route::post('permissions', [PermissionController::class, 'store'])
        ->name('permissions.store')
        ->middleware(['permission:permissions_store'])
    ;

    Route::post('permissions/test', [PermissionController::class, 'test_permission'])
        ->name('permissions.test')
        ->middleware(['permission:permissions_test'])
    ;

    Route::put('permissions/{permission}', [PermissionController::class, 'update'])
        ->name('permissions.update')
        ->middleware(['permission:permissions_update'])
    ;

    Route::delete('permissions/{permission}', [PermissionController::class, 'delete'])
        ->name('permissions.delete')
        ->middleware(['permission:permissions_delete'])
    ;

    Route::delete('permissions/{permission}/force', [PermissionController::class, 'force_delete'])
        ->name('permissions.force_delete')
        ->middleware(['permission:permissions_force_delete'])
    ;

    Route::post('permissions/{permission}/recover', [PermissionController::class, 'recover'])
        ->name('permissions.recover')
        ->middleware(['permission:permissions_recover'])
    ;

    Route::get('permissions/{permission}', [PermissionController::class, 'get_single'])
        ->name('permissions.show')
        ->middleware(['permission:permissions_get_single'])
    ;

    Route::get('roles/{role}/permissions', [RolesPermissionsController::class, 'get_all'])
        ->name('roles.permissions.index')
        ->middleware(['permission:roles_permissions_get_all'])
    ;

    Route::get('roles/{role}/permissions/{permission}/check', [RolesPermissionsController::class, 'check'])
        ->name('roles.permissions.check')
        ->middleware(['permission:roles_permissions_check'])
    ;

    Route::post('roles/{role}/permissions/{permission}/attach', [RolesPermissionsController::class, 'attach'])
        ->name('roles.permissions.attach')
        ->middleware(['permission:roles_permissions_attach'])
    ;

    Route::post('roles/{role}/permissions/{permission}/detach', [RolesPermissionsController::class, 'detach'])
        ->name('roles.permissions.detach')
        ->middleware(['permission:roles_permissions_detach'])
    ;
});

// Badges System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('badges', [BadgeController::class, 'get_all'])
        ->name('badges.get_all')
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

    Route::delete('badges/{badge}', [BadgeController::class, 'delete'])
        ->name('badges.delete')
        ->middleware(['permission:badges_delete'])
    ;

    Route::delete('badges/{badge}/force', [BadgeController::class, 'force_delete'])
        ->name('badges.force_delete')
        ->middleware(['permission:badges_force_delete'])
    ;

    Route::post('badges/{badge}/recover', [BadgeController::class, 'recover'])
        ->name('badges.recover')
        ->middleware(['permission:badges_recover'])
    ;

    Route::get('badges/{badge}', [BadgeController::class, 'get_single'])
        ->name('badges.get_single')
        ->middleware(['permission:badges_get_single'])
    ;

    Route::get('users/{user}/badges', [UserBadgesController::class, 'get_all'])
        ->name('users.badges.get_all')
        ->middleware(['permission:users_badges_get_all'])
    ;

    Route::get('users/{user}/badges/{badge}/check', [UserBadgesController::class, 'check'])
        ->name('users.badges.check')
        ->middleware(['permission:users_badges_check'])
    ;

    Route::post('users/{user}/badges/{badge}/attach', [UserBadgesController::class, 'attach'])
        ->name('users.badges.attach')
        ->middleware(['permission:users_badges_attach'])
    ;

    Route::post('users/{user}/badges/{badge}/detach', [UserBadgesController::class, 'detach'])
        ->name('users.badges.detach')
        ->middleware(['permission:users_badges_detach'])
    ;
});

// Categories System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('categories', [CategoryController::class, 'get_all'])
        ->name('categories.get_all')
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

    Route::delete('categories/{category}', [CategoryController::class, 'delete'])
        ->name('categories.delete')
        ->middleware(['permission:categories_delete'])
    ;

    Route::delete('categories/{category}/force', [CategoryController::class, 'force_delete'])
        ->name('categories.force_delete')
        ->middleware(['permission:categories_force_delete'])
    ;

    Route::post('categories/{category}/recover', [CategoryController::class, 'recover'])
        ->name('categories.recover')
        ->middleware(['permission:categories_recover'])
    ;

    Route::get('categories/{category}', [CategoryController::class, 'get_single'])
        ->name('categories.show')
        ->middleware(['permission:categories_get_single'])
    ;
});

// Tags System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('tags', [TagController::class, 'get_all'])
        ->name('tags.get_all')
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

    Route::delete('tags/{tag}', [TagController::class, 'delete'])
        ->name('tags.delete')
        ->middleware(['permission:tags_delete'])
    ;

    Route::delete('tags/{tag}/force', [TagController::class, 'force_delete'])
        ->name('tags.force_delete')
        ->middleware(['permission:tags_force_delete'])
    ;

    Route::post('tags/{tag}/recover', [TagController::class, 'recover'])
        ->name('tags.recover')
        ->middleware(['permission:tags_recover'])
    ;

    Route::get('tags/{tag}', [TagController::class, 'get_single'])
        ->name('tags.show')
        ->middleware(['permission:tags_get_single'])
    ;
});

// User Management System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('users', [UserMgmtController::class, 'get_all'])
        ->name('users.index')
        ->middleware(['permission:users_get_all'])
    ;

    Route::get('users/{user}', [UserMgmtController::class, 'get_single'])
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

    Route::delete('users/{user}', [UserMgmtController::class, 'delete'])
        ->name('users.delete')
        ->middleware(['permission:users_delete'])
    ;

    Route::delete('users/{user}/force', [UserMgmtController::class, 'force_delete'])
        ->name('users.force_delete')
        ->middleware(['permission:users_force_delete'])
    ;

    Route::post('users/{user}/recover', [UserMgmtController::class, 'recover'])
        ->name('users.recover')
        ->middleware(['permission:users_recover'])
    ;
});

// Ban System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('bans', [BanController::class, 'get_all'])
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

    Route::delete('bans/{ban}', [BanController::class, 'delete'])
        ->name('bans.delete')
        ->middleware(['permission:bans_delete'])
    ;

    Route::get('bans/{ban}', [BanController::class, 'get_single'])
        ->name('bans.show')
        ->middleware(['permission:bans_get_single'])
    ;

    Route::delete('bans/{ban}/force', [BanController::class, 'force_delete'])
        ->name('bans.force_delete')
        ->middleware(['permission:bans_force_delete'])
    ;

    Route::post('bans/{ban}/recover', [BanController::class, 'recover'])
        ->name('bans.recover')
        ->middleware(['permission:bans_recover'])
    ;

    // User Bans

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

    Route::delete('users/{user}/bans/{ban}', [UserBansController::class, 'delete'])
        ->name('users.bans.delete')
        ->middleware(['permission:user_bans_delete'])
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

    Route::delete('posts/comments/{comment}', [PostCommentController::class, 'delete'])
        ->name('posts.comment.delete')
        ->middleware(['permission:posts_comments_delete'])
    ;

    // Report
    Route::get('posts/reports', [PostReportController::class, 'index'])
        ->name('posts.report.get_all')
        ->middleware(['permission:posts_reports_get_all'])
    ;

    Route::get('posts/{post}/reports', [PostReportController::class, 'get_posts'])
        ->name('posts.report.get_post')
        ->middleware(['permission:posts_reports_get_post'])
    ;

    Route::get('posts/reports/{report}', [PostReportController::class, 'show'])
        ->name('posts.report.get_single')
        ->middleware(['permission:posts_reports_get_single'])
    ;

    Route::post('posts/{post}/reports', [PostReportController::class, 'store'])
        ->name('posts.report.store')
        ->middleware(['permission:posts_report_store'])
    ;

    Route::put('posts/reports/{report}', [PostReportController::class, 'update'])
        ->name('posts.report.update')
        ->middleware(['permission:posts_report_update'])
    ;

    Route::delete('posts/reports/{report}', [PostReportController::class, 'delete'])
        ->name('posts.report.delete')
        ->middleware(['permission:posts_report_delete'])
    ;

    // Post History
    Route::get('posts/histories', [PostHistoryController::class, 'get_all'])
        ->name('posts.histories.get_all')
        ->middleware(['permission:posts_history_get_all'])
    ;

    Route::get('posts/{post}/histories', [PostHistoryController::class, 'get_posts'])
        ->name('posts.histories.posts')
        ->middleware(['permission:posts_history_get_posts'])
    ;

    Route::get('posts/histories/{history}', [PostHistoryController::class, 'get_single'])
        ->name('posts.histories.show')
        ->middleware(['permission:posts_history_get_single'])
    ;

    Route::delete('posts/histories/{history}', [PostHistoryController::class, 'delete'])
        ->name('posts.histories.delete')
        ->middleware(['permission:posts_history_delete'])
    ;

    Route::delete('posts/histories/{history}/force', [PostHistoryController::class, 'force_delete'])
        ->name('posts.histories.force_delete')
        ->middleware(['permission:posts_history_force_delete'])
    ;

    Route::post('posts/histories/{history}/recover', [PostHistoryController::class, 'recover'])
        ->name('posts.histories.recover')
        ->middleware(['permission:posts_history_recover'])
    ;

    // Posts
    Route::get('posts', [PostController::class, 'get_all'])
        ->name('posts.index')
        ->middleware(['permission:posts_get_all'])
    ;

    Route::get('posts/{post}', [PostController::class, 'get_single'])
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

    Route::delete('posts/{post}', [PostController::class, 'delete'])
        ->name('posts.delete')
        ->middleware(['permission:posts_delete'])
    ;

    Route::delete('posts/{post}/force', [PostController::class, 'force_delete'])
        ->name('posts.force_delete')
        ->middleware(['permission:posts_force_delete'])
    ;

    Route::post('posts/{post}/recover', [PostController::class, 'recover'])
        ->name('posts.recover')
        ->middleware(['permission:posts_recover'])
    ;
});

// Announcement System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('announcements', [AnnouncementController::class, 'get_all'])
        ->name('announcements.index')
        ->middleware(['permission:announcements_get_all'])
    ;

    Route::get('announcements/{announcement}', [announcementController::class, 'get_single'])
        ->name('announcements.show')
        ->middleware(['permission:announcements_get_single'])
    ;

    Route::post('announcements', [AnnouncementController::class, 'store'])
        ->name('announcements.store')
        ->middleware(['permission:announcements_store'])
    ;

    Route::put('announcements/{announcement}', [AnnouncementController::class, 'update'])
        ->name('announcements.update')
        ->middleware(['permission:announcements_update'])
    ;

    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'delete'])
        ->name('announcements.delete')
        ->middleware(['permission:announcements_delete'])
    ;

    Route::delete('announcements/{announcement}/force', [AnnouncementController::class, 'force_delete'])
        ->name('announcements.force_delete')
        ->middleware(['permission:announcements_force_delete'])
    ;

    Route::post('announcements/{announcement}/recover', [AnnouncementController::class, 'recover'])
        ->name('announcements.recover')
        ->middleware(['permission:announcements_recover'])
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

// Notification System
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('notifications', [NotificationController::class, 'get_all'])
        ->name('notifications.index')
        ->middleware(['permission:notifications_get_all'])
    ;

    Route::get('users/{user}/notifications', [NotificationController::class, 'get_users'])
        ->name('notifications.get_users')
        ->middleware(['permission:notifications_get_user'])
    ;

    Route::get('notifications/{notification}', [NotificationController::class, 'get_single'])
        ->name('notifications.get_single')
        ->middleware(['permission:notifications_get_single'])
    ;

    Route::post('notifications', [NotificationController::class, 'store'])
        ->name('notifications.create')
        ->middleware(['permission:notifications_create'])
    ;

    Route::put('notifications/{notification}', [NotificationController::class, 'update'])
        ->name('notifications.update')
        ->middleware(['permission:notifications_update'])
    ;

    Route::delete('notifications/{notification}', [NotificationController::class, 'delete'])
        ->name('notifications.delete')
        ->middleware(['permission:notifications_delete'])
    ;

    Route::delete('notifications/{notification}/force', [NotificationController::class, 'force_delete'])
        ->name('notifications.force_delete')
        ->middleware(['permission:notifications_force_delete'])
    ;

    Route::post('notifications/{notification}/recover', [NotificationController::class, 'recover'])
        ->name('notifications.recover')
        ->middleware(['permission:notifications_recover'])
    ;
});

// Storage System
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('storage/uploadImage', [StorageController::class, 'upload'])
        ->name('storage.uploadImage')
    ;

    Route::post('storage/uploadEditor', [StorageController::class, 'uploadEditor'])
        ->name('storage.uploadEditor')
    ;
});

// Search
Route::get('search', [SearchController::class, 'search'])
    ->name('search')
    ->middleware(['auth:api']);

Route::get('test/email/{mail}', function($mail) {
    for ($i = 0; $i < 15; $i++) {
        dispatch(new App\Jobs\SendEmailJob($mail));
    }

    dd('send mail successfully !!');
});
