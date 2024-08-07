<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
   
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reports';
    protected $primaryKey = 'id';

   public function barangs(){
       return $this->hasOne(Barang::class,'id','barangs_id');
   }

}
