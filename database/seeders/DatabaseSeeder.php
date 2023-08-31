<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'admin',
            'description' => 'Administrator',
        ]);

        $organik = Role::create([
            'name' => 'organik',
            'description' => 'Tenaga Organik',
        ]);

        $bantuan = Role::create([
            'name' => 'bantuan',
            'description' => 'Tenaga Bantuan',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => $admin->id,
        ]);

        User::factory()->count(30)->create([
            'role_id' => $organik->id,
        ]);

        User::factory()->count(30)->create([
            'role_id' => $bantuan->id,
        ]);
    }
}
