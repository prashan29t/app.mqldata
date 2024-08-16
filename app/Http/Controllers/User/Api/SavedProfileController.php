<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavedUserLinkedinProfile;
use App\Models\LinkedinProfile;
use Illuminate\Support\Facades\Auth;

class SavedProfileController extends Controller
{
    /**
     * Save a LinkedIn profile for the authenticated user based on a single username.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProfile(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'username' => 'required|exists:linkedin_profiles,username',
        ]);

        return $this->saveProfileByUsername($validated['username']);
    }

    /**
     * Save multiple LinkedIn profiles for the authenticated user based on an array of usernames.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveMultipleProfiles(Request $request)
{
    // Validate the request input with custom error messages
    $validated = $request->validate([
        'usernames' => 'required|array',
        'usernames.*' => 'exists:linkedin_profiles,username',
    ], [
        'usernames.required' => 'Please select at least one profile to save.',
        'usernames.array' => 'The profiles should be provided as an array.',
        'usernames.*.exists' => 'One or more of the selected profiles do not exist.',
    ]);

    // Check if the usernames array is empty
    if (empty($validated['usernames'])) {
        return response()->json([
            'success' => false,
            'message' => 'Please select at least one profile to save.',
        ], 400); // 400 Bad Request
    }

    $usernames = $validated['usernames'];
    $userId = Auth::id();
    $savedProfiles = [];
    $errors = [];

    foreach ($usernames as $username) {
        $result = $this->saveProfileByUsername($username, $userId);
        if ($result['success']) {
            $savedProfiles[] = $username;
        } else {
            $errors[] = $result['message'];
        }
    }

    return response()->json([
        'success' => count($errors) === 0,
        'saved_profiles' => $savedProfiles,
        'errors' => $errors,
    ]);
}


    /**
     * Helper function to save a LinkedIn profile by username.
     *
     * @param string $username
     * @param int|null $userId
     * @return array
     */
    protected function saveProfileByUsername(string $username, int $userId = null): array
    {
        $linkedinProfile = LinkedinProfile::where('username', $username)->first();

        if (!$linkedinProfile) {
            return [
                'success' => false,
                'message' => "Please select a profle",
            ];
        }

        if ($userId === null) {
            $userId = Auth::id();
        }

        // Check if the profile is already saved by the user
        $existing = SavedUserLinkedinProfile::where('user_id', $userId)
            ->where('linkedin_profile_id', $linkedinProfile->id)
            ->exists();

        if ($existing) {
            return [
                'success' => true,
                'message' => "Profile for username '$username' already saved.",
            ];
        }

        // Save the profile
        SavedUserLinkedinProfile::create([
            'user_id' => $userId,
            'linkedin_profile_id' => $linkedinProfile->id,
        ]);

        return [
            'success' => true,
            'message' => "Profile for username '$username' saved successfully.",
        ];
    }
}