<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model 
{

    protected $table = 'demandes';
    public $timestamps = true;
    protected $guarded = [''];

    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }

}