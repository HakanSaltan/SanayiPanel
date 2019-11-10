<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class islemHizmetleri extends Model
{
    use SoftDeletes;
    protected $table = 'islem_hizmetleri';

    public function Islem(){
        return $this->hasMany('App\Islemler', 'islem_id', 'id');
    }
    public function Hizmet(){
        return $this->belongsTo('App\Hizmetler', 'hizmet_id', 'id');
    }
}
