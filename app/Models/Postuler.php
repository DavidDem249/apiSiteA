<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postuler extends Model
{
    use HasFactory;

    protected $table = "postulers";
    protected $guarded = [''];

    public function annonce()
    {
        return $this->belongsTo('App\Models\Annonce');
    }
}
