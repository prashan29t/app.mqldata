<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinkedinProfile;
use Illuminate\Http\Request;
use App\Models\SavedUserLinkedinProfile;
use Illuminate\Support\Facades\Auth;
class LinkedinProfilesController extends Controller
{
    public function index(Request $request)
    {
        // Get the search, offset, and limit parameters from the request
        $search = $request->input('search');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);

        // Query to get profiles with optional search
        $query = LinkedinProfile::query();

        if ($search) {
            $query->where('full_name', 'like', '%' . $search . '%')
                ->orWhere('job_title', 'like', '%' . $search . '%')
                ->orWhere('headline', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->orWhere('linkedin_url', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%');
        }

        // Get the total count before applying limit and offset
        $total = $query->count();

        // Apply the offset and limit
        $profiles = $query->skip($offset)->take($limit)->get();

        // Return the JSON response in the required format
        return response()->json([
            'total' => $total,
            'totalNotFiltered' => LinkedinProfile::count(), // Total records without any filters
            'rows' => $profiles,
        ]);
    }

    public function showSelectedProfilesUserlist(Request $request)
    {
        $user_id = Auth::id();
        // Get the search, offset, and limit parameters from the request
        $search = $request->input('search');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);

        // Retrieve profiles saved by the user
        $savedProfilesIds = SavedUserLinkedinProfile::where('user_id', $user_id)
            ->pluck('linkedin_profile_id'); // Assuming `linkedin_profile_id` is the foreign key

        // Query to get profiles with optional search and pagination
        $query = LinkedinProfile::whereIn('id', $savedProfilesIds);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', '%' . $search . '%')
                ->orWhere('job_title', 'like', '%' . $search . '%')
                ->orWhere('headline', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->orWhere('linkedin_url', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%');
            });
        }

        // Get the total count before applying limit and offset
        $total = $query->count();

        // Apply the offset and limit
        $profiles = $query->skip($offset)->take($limit)->get();

        // Return the JSON response in the required format
        return response()->json([
            'total' => $total,
            'totalNotFiltered' => $total, // Total records with filters applied
            'rows' => $profiles,
        ]);
    }







}