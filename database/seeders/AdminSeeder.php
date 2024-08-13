<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('pastibisa'),
            'phone' => '123456789',
            'email' => 'admin@example.com',
        ]);
    }
}
