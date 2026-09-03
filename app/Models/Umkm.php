<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Umkm extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_umkm';
    protected $guarded = [];

    public function produks() {
        return $this->hasMany(Produk::class, 'id_umkm', 'id_umkm');
    }

}
