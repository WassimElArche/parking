<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\place;
use App\Models\User;
use App\Models\reservation;

use Carbon\Carbon; 

class reservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $reservations = reservation::where('status' , '0')->get();
        }
        
        else
            $reservations = Auth::user()->reservations()->get();
        return view('reservation.main' , compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $dernierplace = User::max('listeatt');
        if($user->can('create' , reservation::class)){
            $place = place::where('status' , 'libre')->first();
            if($place != null && $dernierplace == 0){
            $user->reservations()->create([
                'place_id' => $place->id,
                'status' => 1,
                'dateDemande' => Carbon::now()->format('d-m-Y'),
            ]);
            $place->update(['status' => 'occuper']);
            return redirect('/mon-espace');
        }
        else{
            $user->reservations()->create([
                'status' => 0,
                'dateDemande' => Carbon::now()->format('d-m-Y'),
            ]);
            if($dernierplace == null)
                $user->update(['listeatt' => 1]);
            else
                $user->update(['listeatt' => intval($dernierplace)+1]);
        }
        return redirect()->back();
        }
        else
            return redirect()->back()->withErrors(['interdit' => ' Message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $reservation = reservation::find($id);
        if($request->has('resilier') && Auth::user()->can('resilier' , $reservation)){
            $reservation->update(['status' => -1]);
            if($reservation->place_id != null)
                place::find($reservation->place_id)->update(['status' => 'libre']);
            return redirect()->back();
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
