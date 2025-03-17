<?php

namespace App\Listeners;

use App\Events\reserverEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\reservation;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;

class reserverListener
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
    public function handle(reserverEvent $event): void
    {
        $place = $event->place;
        $user = $event->user;
        if($user != null){
            $users = User::where('listeatt' , '>', $user->listeatt)->get();
        foreach($users as $User){
            if($User->listeatt > 0){
                $listeatt = $User->listeatt;
                $User->update(['listeatt' =>  intval($User->listeatt) - 1]);
            }
        }
        
        if($place != null && count($user->reservations) != 0 ){
            $user->reservations()->where('status' , 0)->first()->update([
                'place_id' => $place->id,
                'status' => 1,
                'dateDemande' => Carbon::now()->format('d-m-Y'),
                'dateDeb' => Carbon::now()->format('d-m-Y'),
                'dateExpiration' => Carbon::now()->addWeeks(3)->format('d-m-Y'),
            ]);
        }
            $user->update(['listeatt' => null]);
            $place->update(['status'  => 'occuper']);
        }}
    }

