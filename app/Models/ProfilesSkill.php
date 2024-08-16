<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'linkedin_profile_id',
        'skill',
    ];
}