<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => 'admin@mapokezi.test',
        ], [
            'name' => 'Reception Admin',
            'password' => Hash::make('password'),
        ]);
    }
}
