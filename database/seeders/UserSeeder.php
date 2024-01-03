<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'id' => Str::uuid()->toString(), 
                    'role_id' => DB::table('roles')->pluck('id')[0],
                    'username' => 'admin78',
                    'name' => 'admin',
                    'email' => 'admin@example.com',
                    'phone_number' => '087891176543',
                    'address' => 'Road Victory, floor A3',
                    'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'password' => Hash::make('Admin78#'),
                    'status' => 'offline',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
                ],
                [
                    'id' => Str::uuid()->toString(),
                    'role_id' => DB::table('roles')->pluck('id')[1],
                    'username' => 'member77',
                    'name' => 'member',
                    'email' => 'member@example.com',
                    'phone_number' => '087898985645',
                    'address' => 'Road King, floor A4',
                    'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'password' => Hash::make('Member77#'),
                    'status' => 'offline',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s') 
                ],
            ]
        );
    }
}
