<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfilDesa extends Model
{
    protected $guarded = ['id'];

    public function medias(): HasMany
    {
        return $this->hasMany(DesaMedia::class)->orderBy('urutan');
    }
}
