<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';

    protected $fillable = [
        'id_kurikulum',
        'nama_kurikulum',
        
    ];

    public $timestamps = false;
}


