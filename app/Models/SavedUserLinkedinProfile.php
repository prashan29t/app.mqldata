<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedUserLinkedinProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'linkedin_profile_id',
    ];

    /**
     * Get the user that owns the saved profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the LinkedIn profile associated with the saved profile.
     */
    public function linkedinProfile()
    {
        return $this->belongsTo(LinkedinProfile::class, 'linkedin_profile_id');
    }
}