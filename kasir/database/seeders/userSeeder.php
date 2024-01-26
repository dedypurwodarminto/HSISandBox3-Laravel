<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_users')->insert([
            'name' => 'admin',
            'email' => 'dedy.purowdarminto@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin'
        ]);
    }
}
