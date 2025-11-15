<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPersil extends Model
{
    protected $table = 'dokumen_persil';
    protected $primaryKey = 'dokumen_id';
    protected $fillable = [
        'persil_id',
        'jenis_dokumen',
        'nomor',
        'keterangan'
    ];

    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id');
    }
}
