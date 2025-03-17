<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\reservation;
use App\Models\place;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un administrateur
        User::create([
            'nom' => 'Admin',
            'prenom' => 'System',
            'email' => 'admin@parking.com',
            'password' => Hash::make('password'),
            'role' => 1,
            'listeatt' => 1,
        ]);

        // Création de 5 utilisateurs réguliers
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'nom' => 'Utilisateur' . $i,
                'prenom' => 'Test' . $i,
                'email' => 'user' . $i . '@parking.com',
                'password' => Hash::make('password'),
                'role' => 0,
                'listeatt' => $i,
            ]);
        }

        // Création de 10 places de parking
        for ($i = 1; $i <= 10; $i++) {
            place::create([
                'libellePlace' => "Place " . $i,
                'status' => $i <= 7 ? 'libre' : 'occupée',
            ]);
        }

        // Création de réservations
        // Réservation approuvée
        reservation::create([
            'user_id' => 2, 
            'place_id' => 8,
            'status' => 1, // Approuvée
            'dateDeb' => Carbon::now()->subDays(5)->format('Y-m-d'),
            'dateExpiration' => Carbon::now()->addMonths(3)->format('Y-m-d'),
            'dateDemande' => Carbon::now()->subDays(10)->format('Y-m-d'),
        ]);

        // Réservation approuvée
        reservation::create([
            'user_id' => 3, 
            'place_id' => 9,
            'status' => 1, // Approuvée
            'dateDeb' => Carbon::now()->subDays(15)->format('Y-m-d'),
            'dateExpiration' => Carbon::now()->addMonths(2)->format('Y-m-d'),
            'dateDemande' => Carbon::now()->subDays(20)->format('Y-m-d'),
        ]);

        // Réservation en attente
        reservation::create([
            'user_id' => 4, 
            'place_id' => null,
            'status' => 0, // En attente
            'dateDeb' => null,
            'dateExpiration' => null,
            'dateDemande' => Carbon::now()->subDays(2)->format('Y-m-d'),
        ]);

        // Réservation en attente
        reservation::create([
            'user_id' => 5, 
            'place_id' => null,
            'status' => 0, // En attente
            'dateDeb' => null,
            'dateExpiration' => null,
            'dateDemande' => Carbon::now()->subDays(1)->format('Y-m-d'),
        ]);
    }
}
