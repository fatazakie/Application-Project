<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PembelianDetail extends Model {
    protected $table = 'pembelian_details';
    protected $fillable = [
        'id_pembelian', 'id_brg', 'id_merk', 'id_jenis', 'hrg_beli', 'qty'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id_pembelian');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_brg', 'id_brg');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id_merk');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis', 'id_jenis');
    }
    public function details()
{
    return $this->hasMany(PembelianDetail::class, 'id_pembelian', 'id_pembelian');
}

}


