<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'fatura';

    public function Hizmet(){
        
        return $this->hasMany('App\Hizmet','fatura_id','fatura_id');
    }
    public function Arac(){
        
        return $this->hasMany('App\Arac','arac_id','arac_id');
    }
}
