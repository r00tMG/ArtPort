<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($artisteId)
    {
        $commentaires = Commentaire::where('artiste_id', $artisteId)->with('artiste')->get();
        return response()->json([
            'error' => true,
            'message' => "Requête réussie",
            $commentaires
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        //var_dump('salut');
        /*$request->validate([
            'film_id' => 'required|exists:films,id',
            'rating' => 'required|integer|min=1|max=5',
            'comment' => 'nullable|string',
        ]);
        dd($request->input());*/

        $artiste = Commentaire::create([
            'artiste_id' => $request->artiste_id,
            'comment' => $request->comment,
        ]);
        //dd($rating);
        return response()->json([
            'error' => false,
            'message' => "Votre a bien été ajouté",
            $artiste
        ], Response::HTTP_CREATED);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
