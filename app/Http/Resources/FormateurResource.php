<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FormateurResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'phone' => $this->phone,
            'domaine' => $this->domaine,
            'pays' => $this->pays,
            'ville' => $this->ville,
            'date_creation' => $this->created_at->format('d-m-Y'),
            'status' => $this->status,
        ];
    }
}
