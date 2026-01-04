<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $table = 'penggunaan';
    protected $primaryKey = 'jenis_id';
    protected $fillable = [
        'nama_penggunaan',
        'keterangan',
    ];
}
