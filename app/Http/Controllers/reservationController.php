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
            return view('reservation.main' , compact('reservations'));
        }
        else return redirect()->back();
        
    }


    public function reservationpriseGet(){
        if(Auth::user()->can('viewAny' , User::class)){
            $reservations = reservation::where('status' , 1)->paginate(10);
            return view('reservation.prise' , compact('reservations'));
        }
        
    }

    public function reservationprisePost(){
        return "okKKK";
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
                'dateDeb' => Carbon::now()->format('d-m-Y'),
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
            if($reservation->status == 1)
                $reservation->update([
                                'status' => -1, 
                                'dateExpiration' => Carbon::now()->format('d-m-Y') ,
                            ]);
            else 
                $reservation->update(['status' => -2]);
    
            if($reservation->place_id != null)
                place::find($reservation->place_id)->update(['status' => 'libre']);
            if($reservation->users->listeatt > 0){
                $users = User::where('listeatt' , '>', $reservation->users->listeatt)->get();
                foreach($users as $user){
                    
                    if($user->listeatt > 0){
                        $listeatt = $user->listeatt;
                        $user->update(['listeatt' =>  intval($user->listeatt) - 1]);}
                }
                $reservation->users->update(['listeatt' =>  null]);
            }
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
