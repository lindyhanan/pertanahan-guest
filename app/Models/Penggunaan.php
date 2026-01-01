<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $table = 'penggunaan';
    protected $primaryKey = 'jenis_id';
    public $incrementing = true; // kalau memang auto increment
    protected $keyType = 'int';  // atau 'string' kalau string
    protected $fillable = [
        'nama_penggunaan',
        'keterangan',
    ];
}
