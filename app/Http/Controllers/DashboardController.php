<?php

namespace App\Http\Controllers;

use App\Models\Divisions; // Ensure this matches your Model name
use App\Models\Citizen;   // You will need this for the counts
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all divisions for the dropdown
        $divisions = Divisions::all();
        
        // Get the selected division ID from the request
        $selectedDivisionId = $request->query('division_id');

        // Initialize stats with default values
        $stats = [
            'total' => 0, 
            'men' => 0, 
            'women' => 0,
            'buddhist' => 0, 
            'catholic' => 0
        ];

        // If a division is selected, run the counts
        if ($selectedDivisionId) {
            $stats['total'] = Citizen::where('division_id', $selectedDivisionId)->count();
            $stats['men'] = Citizen::where('division_id', $selectedDivisionId)->where('gender', 'Male')->count();
            $stats['women'] = Citizen::where('division_id', $selectedDivisionId)->where('gender', 'Female')->count();
            $stats['buddhist'] = Citizen::where('division_id', $selectedDivisionId)->where('religion', 'Buddhist')->count();
            $stats['catholic'] = Citizen::where('division_id', $selectedDivisionId)->where('religion', 'Catholic')->count();
        }

        // Pass everything to the view
        return view('dashboard', compact('divisions', 'stats', 'selectedDivisionId'));
    }
}