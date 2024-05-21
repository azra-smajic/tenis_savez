<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\TennisAssociation;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //\App\Models\User::factory(10)->create();

         Role::create([
            'id' => '81d37040-a910-4266-88b5-cc8b70bf7924',
            'role_name' => 'Player',
         ]);
         Role::create([
            'id'=>'bf663a8c-25da-4fb5-9ab3-b7eea439a354',
            'role_name' => 'SA'
         ]);
        Role::create([
            'id'=>'ca2ab5b8-395e-4306-bc2d-8478fe17e6ea',
            'role_name' => 'Tennis association SA'
        ]);

         User::create([
            'id'=>'a455671b-7b00-41fb-a7cf-0823bb2148fc',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'birth_year' => '1970',
            'sex' => '',
            'email' => 'sa@tenis.ba',
            'phone_number'=>'123-456-789',
            'password' => bcrypt('test123')
         ]);

         UserRole::create([
            'id'=>'32730738-87d7-4444-a365-c5b8ac165a5f',
            'user_id' => 'a455671b-7b00-41fb-a7cf-0823bb2148fc',
            'role_id' => 'bf663a8c-25da-4fb5-9ab3-b7eea439a354'
         ]);

    }
}
