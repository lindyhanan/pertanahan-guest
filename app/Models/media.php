<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_url',
        'caption',
        'mime_type',
        'sort_order',
    ];

    /**
     * Helper: return full url for view (uses Storage::url)
     */
    public function getUrlAttribute()
    {
        return \Illuminate\Support\Facades\Storage::url($this->file_url);
    }
}
