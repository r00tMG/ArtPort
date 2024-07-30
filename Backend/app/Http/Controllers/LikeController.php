<?php

namespace App\Http\Controllers;

use App\Models\Artiste;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function index($id)
    {
        $artiste = Artiste::findOrFail($id);
        $likesCount = $artiste->likes()->count();
        $liked = auth()->check() ? $artiste->likes() : false;

        return response()->json([
            'count' => $likesCount,
            'liked' => $liked,
        ]);
    }
    public function store(Artiste $artiste, Request $request)
    {
        $visiteurIp = $request->ip();
        #dd($visiteurIp);

        if (!$artiste->likes()->where('visiteur_ip', $visiteurIp)->exists()) {
            $artiste->likes()->create(['visiteur_ip' => $visiteurIp]);
        }

        return response()->json(['message' => 'Liked']);
    }
    public function destroy(Artiste $artiste, Request $request)
    {
        $visiteurIp = $request->ip();


        $artiste->likes()->where('visiteur_ip', $visiteurIp)->delete();

        return response()->json(['message' => 'Unliked']);
    }

}
