<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'userId' => Str::random(7),
            'empId' => 'sysnc1',
            'name' => 'chandima',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'contact' => '0114528796',
            'password' => Hash::make('12345678'),
            'isActive' => 1,
        ]);
    }
}
