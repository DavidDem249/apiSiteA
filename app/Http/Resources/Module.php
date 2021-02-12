<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Plan as ResourcePlan;
use App\Http\Resources\Demande as ResourceDemande;

class Module extends JsonResource
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
            'slug' => $this->slug,
            'image' => $this->image,
            'stat' => $this->stat,
            'duration' => $this->duration,
            //'store_id' => ResourceStore::collection($this->domains),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'plan' => new ResourcePlan($this->plan),
            'demandeur' => new ResourceDemande($this->demandes),
        ];
    }
}
