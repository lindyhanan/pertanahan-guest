<?php
namespace App\Models;

use App\Models\DokumenPersil;
use Illuminate\Database\Eloquent\Model;

class Persil extends Model
{
    protected $table      = 'persil';
    protected $primaryKey = 'persil_id'; // sesuaikan dengan kolom PK di tabel
    public $incrementing  = true;        // jika auto increment
    protected $keyType    = 'int';
    protected $fillable   = [
        'kode_persil',
        'pemilik_warga_id',
        'luas_m2',
        'penggunaan', // ganti dari 'penggunaan'
        'alamat_lahan',
        'rt',
        'rw',
    ];

    public function dokumen()
    {
        return $this->hasMany(DokumenPersil::class, 'persil_id');
    }

    public function media()
    {
        return $this->hasMany(media::class, 'ref_id')
            ->where('ref_table', 'persil');
    }

}
