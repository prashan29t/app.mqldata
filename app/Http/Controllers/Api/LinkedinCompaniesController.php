<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LinkedinCompany;
use Illuminate\Http\Request;

class LinkedinCompaniesController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter parameters from the request
        $search = $request->input('search');
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 10);

        // Query to get companies with optional search filters
        $query = LinkedinCompany::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('username', 'like', '%' . $search . '%')
                ->orWhere('linkedin_url', 'like', '%' . $search . '%')
                ->orWhere('industry', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->orWhere('created_at', 'like', '%' . $search . '%');
        }

        // Get the total count before applying limit and offset
        $total = $query->count();

        // Apply the offset and limit
        $companies = $query->skip($offset)->take($limit)->get();

        // Return the JSON response in the required format
        return response()->json([
            'total' => $total,
            'totalNotFiltered' => LinkedinCompany::count(), // Total records without any filters
            'rows' => $companies,
        ]);
    }
}