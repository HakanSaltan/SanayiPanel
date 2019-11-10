<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Hizmetler extends Model
{
    use SoftDeletes;
    protected $table = 'hizmetler';
}
