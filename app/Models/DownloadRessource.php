<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadRessource extends Model
{
    use HasFactory;

    protected $table = 'download_ressources';
    public $timestamps = true;
    protected $guarded = [''];
}
