<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\createPosts;
use App\Http\Requests\EditRequest;
use App\Models\postes;
use Exception;
use Illuminate\Http\Request;

class postCrud_ctrl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return "Liste des articles";
    }

    // La creation d'un post
    public function store(createPosts $request)
    {
        try {
            //Code d'insertion des données..
            $post = new postes();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $request->image;
            $post->save();
            
            //la reponse à la requette
            return response()->json([
                "status_code" => 200,
                "status_message" => "Le post a éte bien stoché",
                "data" => $post
            ]);
        } catch (Exception $e) {
           return response()->json($e);
        }
        
    }
    
    // la modification de données à la BDD
    public function edite(EditRequest $request, $id)
    {
        try {
            
            //Le code de la modif
            $post = postes::find($id);
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $request->image;
            $post->save();

            return response()->json([
                "status_code" => 200,
                "status_message" => "La modification s'est bien effectuée!",
                "status_code" => $post
            ]);
            
        } catch (Exception $e) {
            
        }
    }
}