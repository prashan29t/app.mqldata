<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;

class CountyDataController extends Controller
{
    // Method to get all countries with id, name, and iso2
    public function getCountries()
    {
        // Retrieve countries with only id, name, and iso2
        $countries = Country::all(['id', 'name', 'iso2']);

        return response()->json($countries);
    }

    // Method to get states based on the selected country with id, name, and country_code
    public function getStates(Request $request)
    {
        // Validate the country_id input
        $request->validate([
            'country_id' => 'required|exists:countries,id'
        ]);

        // Retrieve states with only id, name, and country_code based on the selected country
        $states = State::where('country_id', $request->country_id)
                       ->get(['id', 'name', 'country_code']);

        return response()->json($states);
    }

    // Method to get cities based on the selected state with id, name, and state_code
    public function getCities(Request $request)
    {
        // Validate the state_id input
        $request->validate([
            'state_id' => 'required|exists:states,id'
        ]);

        // Retrieve cities with only id, name, and state_code based on the selected state
        $cities = City::where('state_id', $request->state_id)
                      ->get(['id', 'name', 'state_code']);

        return response()->json($cities);
    }
}