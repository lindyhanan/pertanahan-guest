<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DokumenPersil;

class Persil extends Model
{
    protected $table = 'persil';
    protected $primaryKey = 'persil_id';
    protected $fillable = [
        'kode_persil',
        'pemilik_warga_id',
        'luas_m2',
        'penggunaan',
        'alamat_lahan',
        'rt',
        'rw'
    ];

    public function dokumen()
    {
        return $this->hasMany(DokumenPersil::class, 'persil_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'persil_id')
                    ->where('ref_table', 'persil')
                    ->orderBy('sort_order', 'asc');
    }
}
