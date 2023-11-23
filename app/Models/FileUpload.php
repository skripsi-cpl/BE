<?php

// app/Models/FileUpload.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileUpload extends Model
{
    use HasFactory;

    protected $table = 'file_upload'; // Sesuaikan dengan nama tabel yang Anda gunakan

    protected $fillable = [
        'file_upload',
        
    ];
    public $timestamps = false;

    
}
