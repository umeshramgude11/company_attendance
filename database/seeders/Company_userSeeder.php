<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class Company_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this is just to allow examiner to get login to system
        DB::table('company_users')->insert([
            'full_name' => 'admin',
            'user_name' => 'admin',
            'password' => md5('admin')
        ]);

        for($i = 0; $i < 20;$i++)
    	{
            DB::table('company_users')->insert([
                'full_name' => Str::random(10),
                'user_name' => Str::random(10),
                'password' => md5(Str::random(10))
            ]);
        }

    }
}
