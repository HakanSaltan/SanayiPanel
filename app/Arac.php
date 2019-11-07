<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Arac extends Model
{
    
    use SoftDeletes;
    protected $table = 'arac';

    public function Hizmet(){
        
        return $this->hasMany('App\Hizmet');
    }
    public function Musteri(){
        
        return $this->belongsTo('App\musteri','musteri_id','id');
    
    }
}
