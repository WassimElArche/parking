<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class place extends Model
{
    public function reservations(){
        return $this->hasMany(User::class,'place_id');
    }

    protected $fillable =  ['libellePlace'];
}
