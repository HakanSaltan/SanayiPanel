<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'fatura';

    public function Hizmet(){
        
        return $this->hasMany('App\Hizmet','fatura_id','fatura_id');
    }
}
