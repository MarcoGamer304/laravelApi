<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\userInformationController;
use App\Http\Controllers\Api\terrainBaseController;

Route::get('/user/{id}', [userInformationController::class, 'getUser']);

Route::get('/user', [userInformationController::class, 'getAllUser']);

Route::post('/user', [userInformationController::class, 'postUser']);

Route::put('/user/{id}', [userInformationController::class, 'putUser']);

Route::patch('/user/{id}', [userInformationController::class, 'patchUser']);

Route::delete('/user/{id}', [userInformationController::class, 'deleteUser']);

Route::get('/terrain/{id}', [terrainBaseController::class, 'getTerrain']);

Route::get('/terrain', [terrainBaseController::class, 'getAllUser']);

Route::post('/terrain', [terrainBaseController::class, 'postTerrain']);


