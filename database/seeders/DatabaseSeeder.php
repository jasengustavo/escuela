<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
      public function run(): void
    {

  
      
        Role::create([

            'id' => Role::ADMINISTRADOR,
            'name' => 'ADMINISTRADOR',
        ]);

        Role::create([

            'id' => Role::SECRETARIO,
            'name' => 'SECRETARIO',
        ]);


        

        User::factory()->create([

            'role_id' => Role::ADMINISTRADOR,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'status' => 1,
            'email_verified_at' => now(),
        ]);

        User::factory()->create([

            'role_id' => Role::SECRETARIO,
            'name' => 'secretario',
            'email' => 'secretario@gmail.com',
            'status' => 1,
            'email_verified_at' => now(),
        ]);

         Setting::factory()->create([
            
            'title' => 'Sistema de Escuela',
           
        ]);

        



        
    }



  
}
