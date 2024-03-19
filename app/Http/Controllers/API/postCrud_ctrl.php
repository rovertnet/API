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
    public function index(Request $request)
    {
        
        //L'affichage de tous les postes
        try {
            //La recherche des informations dans la BDD
            $query = postes::query();
            $nbrInfos = 2;
            $nbrPages = $request->input("page", 1);
            $search = $request->input("search");
            
            if ($search) {
                $query->whereRaw("title LIKE '%".$search."%'");
            }

            $total = $query->count();

            $result = $query->offset(($nbrPages -1) * $nbrInfos)->limit($nbrInfos)->get();
            
            //code d'affichage
            return response()->json([
                'status' => 200,
                'message' => 'Affichage de postes',
                'current_page' => $nbrPages,
                'last_page' => ceil($total / $nbrInfos),
                'items' => $result
            ]);
        } catch (Exception $e) {
            return response()->json($e);
        }
    }

    // La creation d'un post
    public function store(createPosts $request)
    {
        try {
            
            // Télécharger et stocker l'image
            $path = $request->file('image')->store('images');
            
            //Code d'insertion des données..
            $post = new postes();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $path;
            $post->user_id = auth()->user()->id;
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
    public function edite(EditRequest $request, postes $post)
    {
        try {
            //Le code de la modif
            $post->title = $request->title;
            $post->content = $request->content;
            $post->image = $request->image;
            
            if ($post->user_id === auth()->user()->id) {
                $post->save();
            }else{
                return response()->json([
                    "status_code" => 422,
                    "status_message" => "Vous n'êtes pas l'auteur de ce post!"
                ]);
            }

            return response()->json([
                "status_code" => 200,
                "status_message" => "La modification s'est bien effectuée!",
                "data" => $post
            ]);
            
        } catch (Exception $e) {
            return response()->json($e);
        }
    }
    
    //La suppression de post
    public function delete(postes $post){
        try {
            //La vérification de l'auteur de post
            if ($post->user_id === auth()->user()->id) {
                $post->delete();
            }else{
                return response()->json([
                    "status_code" => 422,
                    "status_message" => "Vous n'êtes pas l'auteur de ce post!"
                ]);
            }
            
            return response()->json([
                "status_code" => 200,
                "status_message" => "La suppression a éte effectuée!",
                "data" => $post
            ]);
            
        } catch (Exception $e) {
            
            return response()->json($e);
            
        }
    }

}