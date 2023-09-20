<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function make()
    {
        return $this->belongsTo(Make::class);
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
