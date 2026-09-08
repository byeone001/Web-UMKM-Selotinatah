<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkm';

    protected $primaryKey = 'id_umkm';

    protected $guarded = [];

    public function whatsappNumber(): ?string
    {
        $digits = preg_replace('/\D+/', '', $this->kontak ?? '') ?? '';

        if (str_starts_with($digits, '0')) {
            $digits = '62'.substr($digits, 1);
        }

        return preg_match('/^628[1-9][0-9]{7,11}$/', $digits) === 1 ? $digits : null;
    }

    public function hasValidLocationLink(): bool
    {
        if (! is_string($this->link_lokasi) || ! filter_var($this->link_lokasi, FILTER_VALIDATE_URL)) {
            return false;
        }

        $scheme = strtolower((string) parse_url($this->link_lokasi, PHP_URL_SCHEME));
        $host = strtolower((string) parse_url($this->link_lokasi, PHP_URL_HOST));

        return in_array($scheme, ['http', 'https'], true)
            && in_array($host, ['goo.gl', 'maps.app.goo.gl', 'maps.google.com', 'google.com', 'www.google.com'], true);
    }

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_umkm', 'id_umkm');
    }
}
