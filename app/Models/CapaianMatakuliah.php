<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianMatakuliah extends Model
{
    protected $table = 'cpmk';
    protected $primaryKey = 'id_cpmk';

    protected $fillable = [
        'id_cpmk',
        'nama_cpmk',
        'bobot_cpmk',
        'id_cpl', 
    ];

    public function cpl()
    {
        return $this->belongsTo(CapaianPembelajaran::class, 'id_cpl', 'id_cpl');
    }
   

    public $timestamps = false;
}


