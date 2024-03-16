<?php

use App\Http\Controllers\API\postCrud_ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Qui concerne l'API
Route::get('/', [postCrud_ctrl::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});