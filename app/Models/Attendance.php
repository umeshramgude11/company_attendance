<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;


     protected $table = 'attendance';
     protected $fillable = ['user_id','date'];


     public $timestamps = false;

     protected $softDelete = false;

    //   public function users()
    // {
    //     return $this->hasMany('App\User','user_id','id');
    // }

    public function user()
    {
        return $this->BelongsTo(User::class);
    }

}
