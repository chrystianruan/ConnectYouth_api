<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\UserController;
use \App\Http\Controllers\api\EventController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/new-user', [UserController::class, 'newSimpleUser']);
Route::post('/new-admin-user', [UserController::class, 'newAdminUser']);
Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/user/{id}', [UserController::class, 'getPersonalInfosToUser']);
Route::get('/user/{id}', [UserController::class, 'getPersonalInfosToUser']);
Route::post('/new-event', [EventController::class, 'newEvent']);
Route::get('/events', [EventController::class, 'getAllEvents']);
Route::post('/logon', [AuthController::class, 'authentication']);
