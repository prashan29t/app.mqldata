<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedinCompany extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_job',
        'linkedin_url',
        'username',
        'name',
        'website',
        'address',
        'city',
        'state',
        'zipcode',
        'country',
        'country_code',
        'phone',
        'industry',
        'employees',
        'revenue',
        'about',
    ];

    // Define any relationships here if needed
    public function profiles()
    {
        return $this->hasMany(LinkedinProfile::class, 'company_id');
    }
}