<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\place;
use App\Models\User;
use App\Models\reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Events\reserverEvent;

class placeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

        if(Auth::user()->can('viewAny' , place::class)){
            $places = place::All();
            return view('place.main' , compact('places'));
        }
        else return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if(Auth::user()->can('create' ,place::class )){
            return view('place.create');
        }
        else return redirect()->back();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //plus tard event(new reserverEvent());
        if(Auth::user()->can('create' ,place::class )){
        $request['status'] = 'libre';
        $place = place::create($request->input());
        if($request->has('creeplace')){
            event(new reserverEvent(User::where('listeatt',1)->first() , $place));

        return redirect('/places');
    }
    
    return redirect()->back();
    }
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
        $place = place::find($id);
        if(Auth::user()->can('update' ,$place)){
            return view('place.edit' , compact('place'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $place = place::find($id);
        if(Auth::user()->can('update' , $place)){
            $place->update($request->input());
            return redirect('/places');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $place = place::find($id);
        if(Auth::user()->can('delete' , $place)){
            $resas = reservation::where('place_id' , $place->id)->where('status',1)->get();
            foreach($resas as $resa){
                $resa->update(['status'=> -1 , 'dateExpiration' => Carbon::now()->format('d-m-Y')]);
            }
            $place->delete();
            return redirect('/places');
        }
        return redirect('/places');
    }
}
