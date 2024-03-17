<?php

use App\Http\Controllers\API\postCrud_ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Qui concerne l'API
Route::get('/posts', [postCrud_ctrl::class, 'index']);
Route::post('/posts/create', [postCrud_ctrl::class, 'store']);
Route::post('/posts/edit(id)', [postCrud_ctrl::class, 'update']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});