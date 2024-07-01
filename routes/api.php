<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectCommsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskCommsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProjectController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Register and login
Route::post('/Regester', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::delete('/auth_logout', [AuthController::class, 'logout']);

//--------------------users 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'getall']);
    Route::get('/users/{id}', [UserController::class, 'getUser']);
    Route::post('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    //-----------------------projects
    Route::get('/projects', [ProjectController::class, 'getAll']);
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'getproject']);
    Route::post('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'delete']);
    //-----------------------user-projects
    Route::get('/user-projects', [UserProjectController::class, 'getAll']);
    Route::get('/user-projects/user/{id}', [UserProjectController::class, 'getUser']);
    Route::get('/user-projects/project/{id}', [UserProjectController::class, 'getProject']);
});
Route::middleware(['auth:sanctum', 'checkadmin'])->group(function () {
    Route::post('/user-projects', [UserProjectController::class, 'store']);
    Route::post('/user-projects/{id}', [UserProjectController::class, 'update']);
    Route::delete('/user-projects/{id}', [UserProjectController::class, 'delete']);
    //-------------------------tasks
    Route::get('/task', [TaskController::class, 'getAll']);
    Route::post('/task', [TaskController::class, 'store']);
    Route::post('/task/{id}', [TaskController::class, 'update']);
    Route::delete('/task/{id}', [TaskController::class, 'delete']);
    Route::get('/task_user/{id}', [TaskController::class, 'getuser']);
    Route::get('/task_project/{id}', [TaskController::class, 'getproject']);
});
Route::middleware(['auth:sanctum', 'checktaskholder'])->group(function () {
    //----------------------task_comm

    Route::post('/task_comm', [TaskCommsController::class, 'store']);
    Route::post('/task_comm/{id}', [TaskCommsController::class, 'update']);
    Route::delete('/task_comm/{id}', [TaskCommsController::class, 'delete']);


});
Route::get('/task_comm', [TaskCommsController::class, 'getAll']);
Route::get('/task_commuser/{id}', [TaskCommsController::class, 'getuser']);
Route::get('/task_commproject/{id}', [TaskCommsController::class, 'getproject']);


//----------------------project_comm
Route::middleware(['auth:sanctum', 'checkprojectholder'])->group(function () {

    Route::post('/project_comm', [ProjectCommsController::class, 'store']);
    Route::post('/project_comm/{id}', [ProjectCommsController::class, 'update']);
    Route::delete('/project_comm/{id}', [ProjectCommsController::class, 'delete']);

});
Route::get('/project_comm', [ProjectCommsController::class, 'getAll']);
Route::get('/project_commuser/{id}', [ProjectCommsController::class, 'getuser']);
Route::get('/project_commproject/{id}', [ProjectCommsController::class, 'getproject']);

