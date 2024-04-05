<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileLulusan extends Model
{
    protected $table = 'pl';
    protected $primaryKey = 'id_pl';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_pl',
        'nama_pl',
        'bobot_pl',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public $timestamps = false;
}
