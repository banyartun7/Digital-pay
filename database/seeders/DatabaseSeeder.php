<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdminUser::factory()->create();
        User::factory()->create();

        // AdminUser::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@gmail.com',
        //     'phone' => '097777777',
        //     'password' => bcrypt('12345678'),
        // ]);
    }
}
