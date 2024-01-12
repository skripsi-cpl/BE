<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CpmkMk extends Model
{
    protected $table = 'cpmk_mk';

    protected $fillable = [
        'id_cpmk_mk',
        'id_cpmk',
        'id_mk',
        'bobot_mk',
    ];

    public function capaianMataKuliah()
    {
        return $this->belongsTo(CapaianMatakuliah::class, 'id_cpmk', 'di_cpmk');
    }
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    }
   

    public $timestamps = false;
}


