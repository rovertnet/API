<?php

use App\Http\Controllers\API\postCrud_ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Routes de CRUD Post
Route::get('/posts', [postCrud_ctrl::class, 'index']);
Route::post('/posts/create', [postCrud_ctrl::class, 'store']);
Route::put('/posts/edit/{post}', [postCrud_ctrl::class, 'edite']);
Route::delete('/posts/{post}', [postCrud_ctrl::class, 'delete']);

//Authentification User
Route::post("/createUser", []);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});