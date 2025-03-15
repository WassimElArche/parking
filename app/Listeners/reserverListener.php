<?php

namespace App\Listeners;

use App\Events\reserverEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
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
            if($place != null && $dernierplace == 0){
            $user->reservations()->create([
                'place_id' => $place->id,
                'status' => 1,
                'dateDemande' => Carbon::now()->format('d-m-Y'),
                'dateDeb' => Carbon::now()->format('d-m-Y'),
                'dateExpiration' => Carbon::now()->addWeeks(3)->format('d-m-Y'),
            ]);
            $place->update(['status' => 'occuper']);}
    }
}
