<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class qrOkutulan extends Model
{
    use SoftDeletes;
    protected $table = 'qr_okutulan';
    public function Arac(){
        
        return $this->belongsTo('App\Arac','arac_id','id');
    }
}
