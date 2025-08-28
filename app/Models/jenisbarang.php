<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenisBarang extends Model
{
    protected $table = 'jenis_barangs'; // Atau 'jenis_barang' sesuai tabel
    protected $primaryKey = 'id_jenis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_jenis', 'jenis_brg'];
}
