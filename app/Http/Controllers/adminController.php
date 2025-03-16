<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Hash;
use App\Events\creerUserEvent;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->can('viewAny' , User::class)){
            $users = User::all();
            return view('admin.main' , compact('users'));
        }
        else return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        if(Auth::user()->can('creerUser' , User::class) || true){
            return view('admin.createUser');
        }
        else return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if(Auth::user()->can('create' , User::class))
        {
            $mailerreur = [];
            if($request->users != null){
                $usersTab = preg_split('/[\s,]+/', $request->users);
                foreach($usersTab as $user){
                    if(!filter_var($user, FILTER_VALIDATE_EMAIL))
                        array_push($mailerreur , $user);
                    }
                if(count($mailerreur) == 0)
                    event(new creerUserEvent($usersTab));
                else return redirect()->back()->with('erreurMail' , $mailerreur)->withInput();
                
             }
        }
        return redirect('/admin');
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
        $employe = User::find($id);
        if(Auth::user()->can('update' , $employe)){

            return view('employe.edit', compact('employe'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employe = User::find($id);
        if(Auth::user()->can('update',$employe)){
            $password = $employe->password;
            $role = $employe->role;
            if($request->password != null)
                $password = Hash::make($request->password);
            if($request->role != null)
                $role = intval($request->role);
            $employe->update([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'email' => $request->email,
                'password' => $password,
                'role' => $role,
            ]);
            return redirect('/admin');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(Auth::user()->can('delete',$user)){
            $user->delete();
        }
        return redirect()->back();
    }
}
