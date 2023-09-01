<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ActionPlan;
use App\Models\Role;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Notifications\Action;

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

        $admin = User::factory()->create([
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

        Work::factory()->count(50)->create();
        ActionPlan::factory()->count(200)->create();
        ActionPlan::factory()->count(3)->create([
            'work_id' => 1,
            'user_id' => $admin->id,
        ]);
    }
}
