<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\reservation;
use Illuminate\Console\Command;

class reservationExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reservation-expiration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = reservation::where('dateExpiration','<',Carbon::now())->where('status' , 1)->get();


    }
}
