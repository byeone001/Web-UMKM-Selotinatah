<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $primaryKey = 'id_produk';

    protected $guarded = [];

    public function fotos()
    {
        return $this->hasMany(ProdukFoto::class, 'id_produk', 'id_produk')->orderBy('urutan');
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    }
}
