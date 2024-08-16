<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinProfile extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'batch_job',
        'full_name',
        'first_name',
        'last_name',
        'public_identifier',
        'username',
        'linkedin_url',
        'profile_photo',
        'headline',
        'job_title',
        'snippet',
        'address',
        'city',
        'state',
        'zipcode',
        'country',
        'country_code',
        'followers',
        'connections',
        'about',
        'experience',
        'education',
        'email',
        'phone',
        'website',
        'company_id',
        'premium',
        'location',
        'cover_img',
    ];

    /**
     * Get the company associated with the LinkedIn profile.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(LinkedinCompany::class, 'company_id');
    }

    public function education()
    {
        return $this->hasMany(ProfilesEducation::class,'linkedin_profile_id','id');
    }

    public function skills()
    {
        return $this->hasMany(ProfilesSkill::class,'linkedin_profile_id','id');
    }

    
    public function work_experience()
    {
        return $this->hasMany(ProfilesWorkExperience::class,'id','linkedin_profile_id');
    }


}