<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //1 admin 2 healthcare worker
        User::create([
            'fname' => 'Marian Stephanie',
            'lname' => 'Vergara',
            'email' => 'msvergara@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Yechan',
            'lname' => 'Shin',
            'email' => 'yshin@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Eula Andrea',
            'lname' => 'Dela Cruz',
            'email' => 'eadelacruz@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Vernon Andrew',
            'lname' => 'Tolentino',
            'email' => 'vatolentino@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Joshua Rei',
            'lname' => 'Fernandez',
            'email' => 'jrfernandez@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Brian Henry',
            'lname' => 'De Guzman',
            'email' => 'bhdeguzman@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 2,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'fname' => 'Mary Denise',
            'lname' => 'Santos',
            'email' => 'mdsantos@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('admin2024'),
            'roles' => 2,
            'remember_token' => Str::random(10),
        ]);
    }
}
