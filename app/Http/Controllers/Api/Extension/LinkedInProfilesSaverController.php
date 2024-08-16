<?php

namespace App\Http\Controllers\Api\Extension;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\LinkedInProfile;
use App\Models\ProfilesEducation;
use App\Models\ProfilesSkill;
use App\Models\ProfilesWorkExperience;

class LinkedInProfilesSaverController extends Controller
{
    /**
     * Store the LinkedIn profile data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'username' => 'required|string',
            'linkedin_url' => 'nullable|url',
            'name' => 'nullable|string',
            'headline' => 'nullable|string',
            'image' => 'nullable|string',
            'coverImg' => 'nullable|string',
            'location' => 'nullable|string',
            'followers' => 'nullable|string',
            'connections' => 'nullable|string',
            'isPremium' => 'nullable|boolean',
            'about' => 'nullable|string',
            'experiences' => 'nullable|array',
            'education' => 'nullable|array',
            'skills' => 'nullable|array',
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

       

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 200);
        }

        try {
            // Extract validated data
            $validated = $validator->validated();
            $followers = null;
            $connections = null;

                $followers = $validated['followers'];
            
                $connections = $validated['connections'];
           
            
            $nameParts = explode(' ', $validated['name'], 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : '';
            // Create or update the LinkedIn profile
            $profile = LinkedInProfile::updateOrCreate(
                ['username' => $validated['username']],
                [   
                    'full_xname' => $validated['name'],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'linkedin_url' => $validated['linkedin_url'],
                    'public_identifier' => $validated['username'],
                    'headline' => $validated['headline'],
                    'job_title' => $validated['headline'],
                    'profile_photo' => $validated['image'],
                    'cover_img' => $validated['coverImg'],
                    'location' => $validated['location'],
                    'followers' => $followers,
                    'connections' => $connections,
                    'premium' => $validated['isPremium'],
                    'about' => $validated['about'],
                ]
            );

            // Update work experiences only if the profile exists
            if ($profile->exists && isset($validated['experiences'])) {
                foreach ($validated['experiences'] as $experience) {
                    ProfilesWorkExperience::updateOrCreate(
                        [
                            'linkedin_profile_id' => $profile->id,
                            'company_name' => $experience['companyName'],
                            'job_title' => $experience['jobPositions'][0]['jobTitle'] ?? null,
                        ],
                        [
                            'company_url' => $experience['companyUrl'],
                            'logo_url' => $experience['logoUrl'],
                            'employment_type' => $experience['jobPositions'][0]['employmentType'] ?? null,
                            'duration' => $experience['jobPositions'][0]['duration'] ?? null,
                            'location' => $experience['jobPositions'][0]['location'] ?? null,
                        ]
                    );
                }
            }

            // Update education details only if the profile exists
            if ($profile->exists && isset($validated['education'])) {
                foreach ($validated['education'] as $edu) {
                    ProfilesEducation::updateOrCreate(
                        [
                            'linkedin_profile_id' => $profile->id,
                            'degree' => $edu['degree'],
                        ],
                        [
                            'degree' => $edu['degree'],
                            'institution' => $edu['institution'],
                            'details' => $edu['details'] ?? null,
                            'date_range' => $edu['dateRange'] ?? null,
                        ]
                    );
                }
            }

            // Update skills only if the profile exists
            if ($profile->exists && isset($validated['skills'])) {
                foreach ($validated['skills'] as $skill) {
                    ProfilesSkill::updateOrCreate(
                        [
                            'linkedin_profile_id' => $profile->id,
                            'skill' => $skill,
                        ],
                        [
                            'linkedin_profile_id' => $profile->id,
                            'skill' => $skill,
                        ]
                    );
                }
            }

            return response()->json(['message' => 'Profile data saved successfully.'], 201);

        } catch (\Exception $e) {
            // Log the error and return a response
            Log::error('Failed to save LinkedIn profile data: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to save profile data.'], 500);
        }
    }
}