<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Controllers\Admin\BlogController;
use App\Models\SavedUserLinkedinProfile;
use App\Models\LinkedinProfile;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
       // return view('dashboard.index');
    }

    public function showPeoples()
    {
        $user_id = Auth::id();
                $profiles = SavedUserLinkedinProfile::with('linkedinProfile')
                    ->where('user_id', $user_id)
                    ->get();
        return view('peoples', compact('profiles'));
    }


    public function showcompanies()
    {
        return view('showcompanies');
    }

   


}