<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            
            'id' => $this->id,
            'title' => $this->title,
            'entreprise' => $this->entreprise,
            'phone' => $this->phone,
            'duration' => $this->duration,
            'marge_debut' => $this->marge_debut,
            'marge_salaire' => $this->marge_salaire,
            'description_profil' => $this->description_profil,
            'description_dossier' => $this->description_dossier,
            'image' => $this->image,
            'localisation' => $this->localisation,
            'email' => $this->email,
            'date' => $this->date,
            'phone' => $this->entreprise,
            'contrat_type' => $this->contrat_type,
            'marge_salarial' => $this->marge_salarial,
            'description_annonce' => $this->description_annonce,
            'type_travail' => $this->type_travail,
            'status' => $this->status,
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            //'domain' => ResourceDomain::collection($this->domains),
        ];
    }
}
