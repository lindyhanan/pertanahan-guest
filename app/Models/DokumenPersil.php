<?php

namespace App\Models;
use App\Models\Media;

use Illuminate\Database\Eloquent\Model;

class DokumenPersil extends Model
{
    protected $table = 'dokumen_persil';

    protected $primaryKey = 'dokumen_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'persil_id',
        'jenis_dokumen',
        'nomor',
        'keterangan',
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id')
            ->where('ref_table', 'dokumen_persil');
    }

    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id');
    }
}
