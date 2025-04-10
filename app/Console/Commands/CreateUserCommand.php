<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {nom} {prenom} {email} {password} {--role=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer un nouvel utilisateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nom = $this->argument('nom');
        $prenom = $this->argument('prenom');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = $this->option('role');

        DB::table('users')->insert([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $this->info('Utilisateur créé avec succès !');
    }
}
