<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\place;
use App\Models\User;

class reservation extends Model
{
    public function places(){
        return $this->belongsTo(place::class,'place_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    protected $fillable = [
        'status','place_id','dateDemande'
    ];
}
