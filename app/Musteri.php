<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Musteri extends Model
{
    use SoftDeletes;
    protected $table = 'musteri';

    public function Arac(){
        return $this->hasMany('App\Arac');
    }
    public function Fatura(){
        return $this->hasMany('App\Fatura','musteri_id','musteri_id');
    }
    
}
