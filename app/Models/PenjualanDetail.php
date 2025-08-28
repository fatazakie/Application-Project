<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model {
    protected $table = 'penjualan_details';
    protected $fillable = [
        'id_penjualan', 'id_brg', 'id_merk', 'id_jenis', 'hrg_jual', 'qty'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id_penjualan');
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
    return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id_penjualan');
}

}
