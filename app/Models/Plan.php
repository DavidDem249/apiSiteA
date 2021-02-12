<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model 
{

    protected $table = 'plans';
    public $timestamps = true;
    protected $guarded = [''];

    public function module()
    {
        return $this->hasOne('App\Models\Module');
    }

}