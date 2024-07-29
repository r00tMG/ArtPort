<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function artiste()
    {
        return $this->belongsTo(Artiste::class,'artiste_id');
    }
}
