<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XraysearchController extends Controller
{
    /**
     * Show the X-ray search form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('xraysearch');
    }

    /**
     * Handle the X-ray search request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        // Validate the input data
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Implement the search logic here
        $query = $request->input('query');

        // Example: Perform the search (this is just a placeholder)
        $results = []; // Replace this with actual search results

        return view('xraysearch.results', compact('results', 'query'));
    }
}