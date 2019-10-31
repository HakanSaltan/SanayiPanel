<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Marka extends Model
{
    protected $table = 'marka';

    public function AracModel(){
        return $this->hasMany('App\AracModel');
    }
}
