<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\UserController;
use \App\Http\Controllers\api\EventController;
use \App\Http\Controllers\api\EventUserController;
use \App\Http\Controllers\api\AuthController;

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




Route::post('/new-user', [UserController::class, 'newSimpleUser']);
Route::post('/new-admin-user', [UserController::class, 'newAdminUser']);
Route::get('/users', [UserController::class, 'getUsers']);

Route::get('/events', [EventController::class, 'getAllEvents']);
Route::post('/logon', [AuthController::class, 'authentication']);
Route::middleware('auth:sanctum')->group(function() {
    Route::post('/save/personal-infos', [UserController::class, 'storePersonalInfos']);
    Route::get('/user', [UserController::class, 'showUser']);
    Route::post('/save/event-user', [EventUserController::class, 'storeUserInEvent']);
});

Route::middleware(['auth:sanctum', 'admin'])->group(function() {
    Route::post('/new-event', [EventController::class, 'newEvent']);
    Route::get('/admin/user-infos/{id}', [UserController::class, 'showUserWithPersonalInfos']);
    Route::get('/admin/event/{id}/users', [EventUserController::class, 'getAllParticipantsOfEvent']);
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});
