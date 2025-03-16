<?php

namespace App\Listeners;

use App\Events\creerUserEvent;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;


class creerUserListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(creerUserEvent $event): void
    {
        $users = $event->users;

        if($users != 0)
        {

            foreach($users as $user){
                
                    if(!User::where('email' , $user)->exists()){
                        User::create([
                            'nom' => $user, 
                            'prenom' => $user,
                            'email'=>$user,
                            'password' => bcrypt(Str::random(10)),
                            'role' => 0,
                        ]);
                        Password::sendResetLink(['email' => $user]);
                        
                    }
            }
        
    }
}
}
