<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_mk',
        'kode_mk',
        'nama_mk',
        'sks', 
        'semester_mk',
        'id_kurikulum',
        'id_cpmk', 
    ];

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'id_kurikulum', 'id_kurikulum');
    }
    // public function cpmk()
    // {
    //     return $this->belongsTo(CPL::class, 'id_cpmk', 'id_cpmk');
    // }

    public $timestamps = false;
}


