<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trxdpna extends Model
{
    protected $table = 'trxdpna';

    protected $fillable = [
        'id_trx',
        'id_dpna',
        
    ];
    
    public function dpna()
    {
        return $this->belongsTo(DPNA::class, 'id_dpna', 'id_dpna');
    }
    // public function mataKuliah()
    // {
    //     return $this->belongsTo(MataKuliah::class, 'id_mk', 'id_mk');
    // }

    public $timestamps = false;
}


