<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    protected $table = 'fatura';

    public function IslemHizmetleri(){
        
        return $this->hasMany('App\islemHizmetleri','islem_id','islem_id');
    }

    public function Islemler(){
        
        return $this->hasMany('App\Islemler','islem_id','id');
    }
    public function Musteri(){
        
        return $this->hasMany('App\Musteri','musteri_id','id');
    }
}
