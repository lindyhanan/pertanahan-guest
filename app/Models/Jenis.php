<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = 'jenis_penggunaan';
    protected $primaryKey = 'jenis_id';
    protected $fillable = [
        'nama_penggunaan',
        'keterangan',
    ];
}
