<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SengketaPersil extends Model
{
    protected $table      = 'sengketa_persil';
    protected $primaryKey = 'sengketa_id';
    protected $fillable   = ['persil_id', 'pihak_1', 'pihak_2', 'kronologi', 'status', 'penyelesaian'];

    public function persil()
    {
        return $this->belongsTo(Persil::class, 'persil_id', 'persil_id');
        //  ^ foreign key di SengketaPersil  ^ primary key di Persil
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'sengketa_id')
            ->where('ref_table', 'sengketa_persil');
    }
}
