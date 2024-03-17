<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitorController;


Route::post('/access',[VisitorController::class,'state_status']);
Route::post('/visitor',[VisitorController::class,'store']);
Route::post('/login',[UserController::class,'login']);
// Route::group(['middleware'=>['auth:sanctum']], function () {
//     //
    
//  });
