<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Arac extends Model
{
    
    use SoftDeletes;
    protected $table = 'arac';

    public function Fatura(){
        
        return $this->hasMany('App\Fatura');
    }
    public function Musteri(){
        
        return $this->belongsTo('App\musteri','musteri_id','id');
    }
}
