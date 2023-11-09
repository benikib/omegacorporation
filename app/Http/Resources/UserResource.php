<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "nom"=> $this->nom,
            "post_nom"=> $this->post_nom,
            "prenom"=> $this->prennom,
            "adresse"=> $this->adresse,
            "picture"=> $this->picture,
            "telephone"=> $this->telephone,
            "email"=> $this->email,
        ];
    }
}
