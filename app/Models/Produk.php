<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';
    protected $guarded = [];

    public function umkm() {
        return $this->belongsTo(Umkm::class, 'id_umkm', 'id_umkm');
    } 
}
