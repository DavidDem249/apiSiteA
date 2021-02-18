<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;


    protected $table = 'formateurs';
    public $timestamps = true;
    protected $guarded = [''];


}
