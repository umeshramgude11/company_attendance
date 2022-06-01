<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip_whitelisting extends Model
{
    use HasFactory;


     protected $table = 'ip_whitelisting';

     protected $guarded = [];
     public $timestamps = false;

     protected $softDelete = false;

      public function users()
    {
        return $this->hasMany('App\User','user_id','id');
    }


}
