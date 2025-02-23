<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PendudukSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        $this->call([
            PendudukSeeder::class,
        ]);
        User::factory()->create([
            'name' => 'Rahmat Afriyadi',
            'email' => 'admin@admin.com',
            'password' => 'test12345',
            'desa_id'=>1
        ]);
    }
}
