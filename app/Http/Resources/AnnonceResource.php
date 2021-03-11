<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostulerResource;

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
            'phone' => $this->phone,
            'contrat_type' => $this->contrat_type,
            'marge_salarial' => $this->marge_salarial,
            'description_annonce' => $this->description_annonce,
            'type_travail' => $this->type_travail,
            'status' => $this->status,
            'diplome' => $this->diplome,
            'dure_experience' => $this->dure_experience,
            'comp_tech' => $this->comp_tech,
            'aptitude_pro' => $this->aptitude_pro,
            'postulants' => PostulerResource::collection($this->postulants),
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            //'domain' => ResourceDomain::collection($this->domains),
        ];
    }
}
