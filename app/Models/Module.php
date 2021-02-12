<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model 
{

    protected $table = 'modules';
    public $timestamps = true;
    protected $guarded = [''];

    public function formation()
    {
        return $this->belongsTo('App\Models\Formation');
    }

    public function plan()
    {
        return $this->hasOne('App\Models\Plan');
    }

    public function demandes()
    {
        return $this->hasMany('App\Models\Demande');
    }

}