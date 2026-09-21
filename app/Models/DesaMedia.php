<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DesaMedia extends Model
{
    protected $table = 'desa_medias';

    protected $guarded = ['id'];

    public function profilDesa(): BelongsTo
    {
        return $this->belongsTo(ProfilDesa::class);
    }

    public function isVideo(): bool
    {
        return $this->type === 'video';
    }
}
