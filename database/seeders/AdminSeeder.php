<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "name" => "AdminSimpananBPS",
            "email" => "BPSAdmin@gmail.com",
            "password" => Hash::make('AdminSimpanan'),
            "role" => "Admin"
        ];
        User::create($data);
    }
}
