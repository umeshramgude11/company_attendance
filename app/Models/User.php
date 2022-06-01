<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

     protected $table = 'users';

     protected $guarded = [];
     public $timestamps = false;

     protected $softDelete = false;

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function ips()
    {
        return $this->hasMany(Ip_whitelisting::class);
    }
}
