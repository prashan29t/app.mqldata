<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'linkedin_profile_id',
        'institution',
        'degree',
        'details',
        'daterange',
    ];

    
}