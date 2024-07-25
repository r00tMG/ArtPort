<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArtisteResource extends JsonResource
{
    public static $wrap = "artistes";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'image' => $this->resource->image,
            'titre' => $this->resource->titre,
            'description' => $this->resource->description
        ];
    }
}
