<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    // A state belongs to a country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // A state can have many cities
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}