<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;





class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs'; // Pastikan sesuai nama tabel

    protected $primaryKey = 'id_brg';
    public $incrementing = false; // Karena id_brg bukan auto-increment
    protected $keyType = 'string'; // Ganti ke 'string' kalau pakai ID seperti BR001

    protected $fillable = [
        'id_brg',
        'id_merk',
        'id_jenis',
        'nm_brg',
        'nm_merk',
        'jenis_brg',
        'hrg_beli',
        'hrg_jual',
        'qty',
    ];
    
    public function penjualans()
{
    return $this->hasMany(Penjualan::class, 'id_brg');
}

    public function merk()
{
    return $this->belongsTo(Merk::class, 'id_merk');
}

}
