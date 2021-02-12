<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model 
{

    protected $table = 'domains';
    public $timestamps = true;
    protected $guarded = [''];

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function formations()
    {
        return $this->hasMany('App\Models\Formation');
    }

}