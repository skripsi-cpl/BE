<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// TahunAjaran model
class TahunAjaran extends Model
{
    protected $table = 'tahun_ajaran';

    protected $fillable = [
        'id_TA',
        'periode',
    ];

    public $timestamps = false;
}

