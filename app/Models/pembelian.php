<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Pembelian extends Model {
    protected $table = 'pembelians';
    protected $primaryKey = 'id_pembelian';
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
      'id_pembelian',
      'tgl_pembelian',
      // kalau ada pelanggan / user tambahkan di sini
    ];
    
    public function details()
    {
        return $this->hasMany(PembelianDetail::class, 'id_pembelian', 'id_pembelian');
    }
    public function items()
{
    return $this->hasMany(PembelianItem::class, 'id_pembelian', 'id_pembelian');
}
  
}




