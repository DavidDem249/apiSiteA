<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Store as ResourceStore;
use App\Http\Resources\Formation as ResourceFormation;

class Domain extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => $this->image,
            //'store_id' => new ResourceStore($this->store),
            //'created_at' => $this->created_at,
            //'updated_at' => $this->updated_at,
            'formations' => ResourceFormation::collection($this->formations),
        ];
    }
}
