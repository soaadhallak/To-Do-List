<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ToDoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/users')->group(function(){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout'])->middleware('auth:api');
});


Route::middleware('auth:api')->group(function(){

    Route::get('/todo',[ToDoController::class,'index']);
    Route::get('/todo/{todo}',[ToDoController::class,'show']);
    Route::patch('/todo/{todo}/completed', [TodoController::class, 'Completed']);

    Route::middleware('role')->group(function(){
        Route::post('/todo',[ToDoController::class,'store']);
        Route::post('/todo/{todo}',[ToDoController::class,'update']);
        Route::delete('/todo/{todo}',[ToDoController::class,'destroy']);
        Route::post('/invite-user', [InvitationController::class, 'invite']);
    });
});




