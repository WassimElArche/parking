<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\place;
use App\Models\User;
use App\Models\reservation;
use App\Events\reserverEvent;

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

    public function choixresa($id){
        if(Auth::user()->can('choisir' , reservation::class)){
            $reservations = reservation::where('status', 1)->get();
            $user = User::find($id);
            return view('reservation.choixResa' , compact('reservations' , 'user'));
        }
        return redirect()->back()->withErrors(['place' => ' Message']);
    }



    public function choixresaPost(Request $request,String $id){
        $user = User::find($id);
        $oldReservation = reservation::find($request->reservation);
        if(Auth::user()->can('update', $oldReservation)){
            if($user != null){
                $users = User::where('listeatt' , '>', $user->listeatt)->get();
                foreach($users as $User){
                    if($User->listeatt > 0){
                        $listeatt = $User->listeatt;
                        $User->update(['listeatt' =>  intval($User->listeatt) - 1]);
                    }
                }
            }
        $user->update(['listeatt' => null]);
        $reservation = $user->reservations->where('status' , 0)->first();
        $reservation->update([
            'status' => 1,
            'place_id' => $oldReservation->place_id,
            'dateDeb' => Carbon::now()->format('d-m-Y'),
            'dateExpiration' => Carbon::now()->addWeeks(3)->format('d-m-Y'),
        ]);
        $oldReservation->update([
            'status' => -1,
            'place_id' => $oldReservation->place_id,
            'dateExpiration' => Carbon::now()->format('d-m-Y'),
        ]);

    }
    return redirect('/reservation');

    }


    public function reservationpriseGet(){
        if(Auth::user()->can('viewAny' , User::class)){
            $reservations = reservation::where('status' , 1)->paginate(10);
            return view('reservation.prise' , compact('reservations'));
        }
        
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
            if($place != null && $dernierplace == null){
            $user->reservations()->create([
                'place_id' => $place->id,
                'status' => 1,
                'dateDemande' => Carbon::now()->format('d-m-Y'),
                'dateDeb' => Carbon::now()->format('d-m-Y'),
                'dateExpiration' => Carbon::now()->addWeeks(3)->format('d-m-Y'),
            ]);
            $place->update(['status' => 'occuper']);
            return redirect('/mon-espace')->with(['valider' => ' Message']);
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
        $resa = reservation::find($id);
        if(Auth::user()->can('update' , $resa)){
            return view('reservation.edit', compact('resa'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = reservation::find($id);
        if($reservation->users->listeatt != null)
            $users = User::where('listeatt' , '>', $reservation->users->listeatt)->where('user_id','!=', $reservation->user_id)->get();
        if($request->has('resilier') && Auth::user()->can('resilier' , $reservation)){
                if($reservation->status == 1)
                    {
                        $reservation->update([
                                    'status' => -1, 
                                    'dateExpiration' => Carbon::now()->format('d-m-Y') ,
                        ]);
                        $reservation->places->update(['status' => 'libre']);
                        event(new reserverEvent(User::where('listeatt',1)->first() , $reservation->places));

                    }
                else{
                    
                    $reservation->update(['status' => -2]);
                    if($reservation->users->listeatt >= 1){
                        foreach($users as $user){
                            
                            if($user->listeatt > 0){
                                $listeatt = $user->listeatt;
                                
                                $user->update(['listeatt' =>  intval($user->listeatt) - 1]);
                            }
                        }
                        $reservation->users->update(['listeatt' =>  null]);
                    }
                    
                }
                return redirect()->back();
        }
        else if($request->has('modifier') && Auth::user()->can('attribuer' , reservation::class)){
            $validated = $request->validate([
                'dateExpiration' => 'required|date|after:' . $reservation->dateDeb.'|after:today',
            ]);
            $reservation->update([ 'dateExpiration'=> Carbon::parse($request->dateExpiration)->format('d-m-Y')  ]);
        }
        else
            return redirect()->back()->withErrors(['pasDispo' => "Message"]);

        return redirect('/reservationprise');
    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
