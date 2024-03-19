<?php

use App\Http\Controllers\API\authUser_ctrl;
use App\Http\Controllers\API\postCrud_ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Routes de CRUD Post
Route::get('/posts', [postCrud_ctrl::class, 'index']);


Route::delete('/posts/{post}', [postCrud_ctrl::class, 'delete']);

//Authentification User
Route::post("/createUser", [authUser_ctrl::class, 'register']);
Route::post("/loginUser", [authUser_ctrl::class, 'login']);

//La route la plus sécurisée
Route::middleware('auth:sanctum')->group(function (){
  
  //Création d'un post
  Route::post('/posts/create', [postCrud_ctrl::class, 'store']);
  
  //La modification du post
  Route::put('/posts/edit/{post}', [postCrud_ctrl::class, 'edite']);
  
  //Retourner Utilisateur connecté
  Route::get('/user', function (Request $request) {
      return $request->user();
  });
});