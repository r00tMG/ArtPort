<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArtisteResource;
use App\Models\Artiste;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    //
    public function home(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'error' => false,
            'message' => "Votre requête a réussie",
            'storage' => asset('/storage'),
            ArtisteResource::collection(Artiste::all())
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $artiste = Artiste::find($id);
        return response()->json([
        'error' => false,
        'message' => "Votre requête a réussie",
        'storage' => asset('/storage'),
        $artiste
    ], Response::HTTP_OK);
    }
}
