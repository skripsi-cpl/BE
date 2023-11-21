<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapaianPembelajaran extends Model
{
    protected $table = 'cpl';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_cpl',
        'nama_cpl',
        'bobot_cpl',
        'id_pl',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public function profileLulusan()
    {
        return $this->belongsTo(ProfileLulusan::class, 'id_pl', 'id_pl');
    }

    public $timestamps = false;
}
