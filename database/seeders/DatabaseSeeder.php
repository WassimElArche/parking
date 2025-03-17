<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\reservation;
use App\Models\place;
use Carbon\Carbon; 
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nom' => 'test',
            'prenom' => 'test',
            'email' => 'a@a',
            'password' => 'a',
            'role'=>1,
            'listeatt'=>1,
        ]);

        User::factory()->create([
            'nom' => 'test',
            'prenom' => 'test',
            'email' => 'b@b',
            'password' => 'a',
            'role'=> 0
        ]);

        place::create([
            'libellePlace' => "placeTest",
            'status' => 'libre',
        ]);


        reservation::create([
            'user_id' => 1,  
            'place_id' => 1, 
            'status' => 0,  
            'dateDeb' => Carbon::now()->format('Y-m-d'),
            'dateExpiration' => Carbon::now()->addWeeks(3)->format('Y-m-d'), 
            'dateDemande' => Carbon::now()->format('Y-m-d'), 
        ]);
    }
}




    

