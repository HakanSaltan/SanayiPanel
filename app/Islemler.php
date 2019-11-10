<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Islemler extends Model
{
    use SoftDeletes;
    protected $table = 'islemler';
    
    public function IslemHizmetleri(){
        return $this->belongsToMany('islem_hizmetleri','islem_id', 'hizmet_id');
    }
}
