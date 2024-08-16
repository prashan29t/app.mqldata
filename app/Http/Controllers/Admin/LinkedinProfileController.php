<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkedinProfile;

class LinkedinProfileController extends Controller
{
    /**
     * Display a listing of the LinkedIn profiles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.linkedin.linkedin_profiles');
    }

    /**
     * Fetch the LinkedIn profiles data for DataTable.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getProfiles(Request $request)
    {
        $query = LinkedinProfile::query();

        if ($request->has('search') && $request->search['value'] != '') {
            $searchValue = $request->search['value'];
            $query->where('full_name', 'like', '%' . $searchValue . '%')
                ->orWhere('job_title', 'like', '%' . $searchValue . '%')
                ->orWhere('country', 'like', '%' . $searchValue . '%');
        }

        $profiles = $query->paginate($request->input('length', 10));

        return response()->json([
            'draw' => $request->input('draw'),
            'recordsTotal' => $profiles->total(),
            'recordsFiltered' => $profiles->total(),
            'data' => $profiles->items(),
        ]);
    }
}