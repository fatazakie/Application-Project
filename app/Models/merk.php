<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class merk extends Model
{
    protected $table = 'merks'; // Atau 'merk' kalau itu nama tabelnya
    protected $primaryKey = 'id_merk';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = ['id_merk', 'nm_merk'];
}
