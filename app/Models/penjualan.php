<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model {
    protected $table = 'penjualans';
    protected $primaryKey = 'id_penjualan';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
      'id_penjualan',
      'tgl_penjualan',
      // kalau ada pelanggan / user tambahkan di sini
    ];
    
    public function details()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id_penjualan');
    }
    public function items()
{
    return $this->hasMany(PenjualanItem::class, 'id_penjualan', 'id_penjualan');
}
  
}
