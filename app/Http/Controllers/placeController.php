<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\place;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->can('create' ,place::class )){
        place::create($request->input());
        return redirect('/places');
    }
    return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
