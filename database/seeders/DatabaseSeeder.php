<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call roles and permissions seeder first
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Create admin user
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@sdew.com.br',
        ]);
        $admin->assignRole('administrador');

        // Create test user
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $testUser->assignRole('professor');
    }
}
