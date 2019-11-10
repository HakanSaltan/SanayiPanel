<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class islemHizmetleri extends Model
{
    protected $table = 'islem_hizmetleri';

    public function Islem(){
        return $this->hasMany('App\Islemler', 'id', 'islem_id');
    }
    public function Hizmet(){
        return $this->belongsTo('App\Hizmetler', 'hizmet_id', 'id');
    }
    public function HizmetMany(){
        return $this->hasMany('App\Hizmetler', 'id', 'hizmet_id');
    }
}
