<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
  /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barangs';
    protected $primaryKey = 'id';

    public function reports(){
        return $this->belongTo(Report::class);
    }
}
