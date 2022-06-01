<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i = 0; $i < 20;$i++)
    	{
    		DB::table('users')->insert([
            'full_name' => Str::random(10),
            'user_name' => Str::random(10),

            'DOJ' => Carbon::now()->subMinutes(rand(1, 55)),
            'email' => Str::random(10).'@gmail.com',
            'password' => md5(Str::random(10))
        ]);
    	}

    }
}
