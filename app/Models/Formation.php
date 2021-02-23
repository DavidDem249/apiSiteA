<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model 
{

    protected $table = 'formations';
    public $timestamps = true;
    protected $guarded = [''];

    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }

    public function modules()
    {
        return $this->hasMany('App\Models\Module');
    }

}