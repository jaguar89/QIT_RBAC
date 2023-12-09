<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


//         \App\Models\User::factory()->create([
//             'name' => 'Normal Admin',
//             'email' => 'test@test.com',
//             'email_verified_at' => now(),
//             'password' =>  Hash::make('password'),
//         ]);


        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
