<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\createPosts;
use App\Models\postes;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(createPosts $post)
    {
        //
        $post = new postes();
        $post->title = "Informatique";
        $post->content = "Je suis un article";
        $post->image = "Je suis une image de cet article";
        $post->save();
        
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