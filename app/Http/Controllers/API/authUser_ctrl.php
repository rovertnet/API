<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\authUser;
use App\Http\Requests\loginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authUser_ctrl extends Controller
{
    /**
     * La création de l'utilisateur
     */
    public function register(authUser $request)
    {
       try {
        
         //Le code de la création de USER
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password, [
            'rounds' => 12
        ]);
        $user->save();
        
        //Message de confirmation
        return response()->json([
                "status_code" => 200,
                "status_message" => "Vous êtes bien enregistré!",
                "data" => $user
        ]);
        
       } catch (Exception $e) {
         return response()->json($e);
       }
    }

    /**
     * La connexion de l'utilisateur
     */
    public function login(loginRequest $request)
    {
        //la logique 
        try {
            
            if (auth()->attempt($request->only(['email', 'password']))) {
                //Si les informations se correspondent à celles dans la BDD
                
                $user = auth()->user();
                $token = $user->createToken('LA_SECRETE_DE_API')->plainTextToken;
                
                return response()->json([
                    "status_code" => 200,
                    "status_message" => "Utilisateur connecté!",
                    "user" => $user,
                    "token" => $token
                ]);
            
            }else{
                //Si les informations ne se correspondent pas 
                return response()->json([
                    "status_code" => 403,
                    "status_message" => "Une erreur s'est produite lors de votre connextion"
                ]);
            }
            
        } catch (Exception $e) {
            
            return response()->json($e);
            
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}