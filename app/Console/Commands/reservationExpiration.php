<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\reservation;
use App\Models\User;
use App\Models\Place;
use Illuminate\Console\Command;

class reservationExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservationExpiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Annuler';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = reservation::where('dateExpiration','<',Carbon::now())->where('status' , 1)->get();
        $user = User::where('listeatt' , 1)->first();
        foreach($reservations as $reservation){
            $reservation->update([ 
                'status'=> -1,
            ]);
            $reservation->places->update([ 
                'status'=> 'libre',
            ]);
            $place = Place::where('status' , 'libre')->first();
            if($user != null && $place != null){
                $user->reservations()->where('status' , 0)->first()->update([
                    'place_id' => $place->id,
                    'status' => 1,
                    'dateDemande' => Carbon::now()->format('d-m-Y'),
                    'dateDeb' => Carbon::now()->format('d-m-Y'),
                    'dateExpiration' => Carbon::now()->addWeeks(3)->format('d-m-Y'),
                ]);
                $places->update([ 
                    'status'=> 'occuper',
                ]);
            }
        }
    }
}
