<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPersil extends Model
{
    protected $table      = 'dokumen_persil'; // tambahkan ini
    protected $primaryKey = 'dokumen_id';     // kalau PK bukan 'id'
    protected $fillable   = ['persil_id', 'jenis_dokumen', 'nomor', 'keterangan'];

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'dokumen_id')
            ->where('ref_table', 'dokumen_persil');
    }

    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
    }

}
