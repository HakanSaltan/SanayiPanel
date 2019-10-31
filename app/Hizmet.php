<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Hizmet extends Model
{
    
    use SoftDeletes;
    protected $table = 'hizmet';

    public function Muhasebe(){
        return $this->belongsToMany(Muhasebe::class);
    }
}
