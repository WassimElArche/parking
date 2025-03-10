<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\reservation;

class place extends Model
{
    public function reservations(){
        return $this->hasMany(reservation::class,'place_id');
    }

    protected $fillable =  [
        'libellePlace' , 'status'
];
}
