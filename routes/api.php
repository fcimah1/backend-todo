<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

// group of routes of Tasks
Route::group([], function () {
    Route::get('tasks', [TaskController::class, 'all']);
    Route::get('tasks/{id}',[TaskController::class, 'getTaskBtId']);
    Route::get('tasks/done/{is_done}',[TaskController::class, 'doneTasks']);
    Route::delete('tasks/delete/{id}',[TaskController::class, 'deleteTask']);
    Route::post('tasks/create',[TaskController::class, 'createTask']);
    Route::put('tasks/update/{id}',[TaskController::class, 'updateTask']);
});

// group of routes of Users
Route::group([], function () {
    Route::get('users', [UserController::class, 'all']);
    Route::get('users/{id}',[UserController::class, 'getUserById']);
    Route::delete('users/delete/{id}',[UserController::class, 'deleteUser']);
    Route::post('users/create',[UserController::class, 'addUser']);
    Route::put('users/update/{id}',[UserController::class, 'updateUser']);
});