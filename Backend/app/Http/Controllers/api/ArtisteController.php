<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArtisteFormRequest;
use App\Http\Resources\ArtisteResource;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $artistes = Artiste::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();
        //dd($artistes);
        return  response()->json([
            'error' => false,
            'storage' => asset('storage'),
            'message' => "Votre requête a bien réussie",
             ArtisteResource::collection($artistes)
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArtisteFormRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('images');
        }
        #dd($data);
        $artiste = Artiste::create([
            'titre' => $data['titre'],
            'description' => $data['description'],
            'image' => $data['image'],
            'user_id' => Auth::id()
        ]);
        #dd($artiste);
        return \response()->json([
            'error' => false,
            'message' => "Votre oeuvre a été bien créé",
            'storage' => asset('storage'),
            $artiste
        ], Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $artiste = Artiste::find($id);
        #dd($artiste);
        if($artiste == null)
        {
            return \response()->json([
                'error' => true,
                'message' => "L'oeuvre n'existe pas"
            ]);
        }else{
            return \response()->json([
                'error' => false,
                'message' => "Votre requête a bien réussie",
                'storage' => asset('storage'),
                $artiste
            ], Response::HTTP_OK);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Artiste $artiste
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ArtisteFormRequest $request, $id)
    {

        //dd($id);
        $artiste = Artiste::find($id);

        if ($artiste == null){
            return \response()->json([
                'error' => true,
                'message' => "L'oeuvre que vous essayez de modifier n'existe pas"
            ]);
        }
        //dd($artiste);

        $data = $request->validated();
        dd($data);
        if ($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('images');
        }
        #$data['image'] = $request->image->store('image');
        $artiste = Artiste::update($data);
        dd($artiste);

        return \response()->json([
            'error' => false,
            'message' => "Votre oeuvre a bien été modifié",
            $artiste
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artiste  $artiste
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $artiste = Artiste::find($id);
        if ($artiste == null){
            return \response()->json([
                'error' => true,
                'message' => "L'oeuvre que vous essayez de supprimer n'existe pas"
            ]);
        }
        return \response()->json([
            'error'=> false,
            'message' => "Votre oeuvre a bien été supprimé",
            $artiste->delete()
        ], Response::HTTP_NO_CONTENT);
    }
}
