<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesWorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'linkedin_profile_id',
        'company_name',
        'company_url',
        'logo_url',
        'job_title',
        'employment_type',
        'duration',
        'location',
    ];

}