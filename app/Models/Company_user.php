<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_user extends Model
{
    use HasFactory;
    protected $table = 'company_users';

     protected $guarded = [];
     public $timestamps = false;

     protected $softDelete = false;
}
