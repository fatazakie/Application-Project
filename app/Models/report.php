<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Penjualan;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'id_jenis',
        'id_merk',
        'id_brg',
        'jenis_brg',
        'nm_merk',
        'nm_brg',
        'hrg_beli',   // ✅ disamakan dengan controller & DB
        'hrg_jual',   // ✅ disamakan
        'qty',
        'jumlah',
        'modal',
        'laba',
        'zakat',
        'laba_bersih'
    ];

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_brg', 'id_brg');
    }

    // Kalau memang butuh relasi ke pembelian & penjualan, 
    // pastikan tambahkan kolom pembelian_id & penjualan_id di tabel reports.
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id', 'id');
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
    }
}
