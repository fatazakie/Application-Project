<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    protected $fillable = ['id_hutang', 'tgl_hutang', 'id_merk', 'id_jenis', 'id_brg', 'jumlah_hutang'];

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id_merk');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis', 'id_jenis');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_brg', 'id_brg');
    }
}
