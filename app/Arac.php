<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Arac extends Model
{
    
    use SoftDeletes;
    protected $table = 'arac';

    public function Islemler(){
        
        return $this->hasMany('App\Islemler','arac_id','id')->orderBy('created_at', 'DESC');
    }
    public function Fatura(){
        
        return $this->hasMany('App\Fatura','arac_id','id')->orderBy('created_at', 'DESC');
    }
    public function Musteri(){
        
        return $this->belongsTo('App\Musteri','musteri_id','id');
    }
}
