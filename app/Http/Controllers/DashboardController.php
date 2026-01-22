<?php

namespace App\Http\Controllers;

use App\Models\Divisions; 
use App\Models\Citizens;   // Using the plural model name you created
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $divisions = Divisions::all();
        $selectedDivisionId = $request->query('division_id');

        $stats = [
            'total' => 0, 'men' => 0, 'women' => 0,
            'buddhism' => 0, 'christianity' => 0
        ];

        // Initialize empty collections
        $households = collect();
        $citizens = collect();

        if ($selectedDivisionId) {
            $citizenQuery = Citizens::where('division_id', $selectedDivisionId);
            
            // Fetch stats
            $stats['total'] = (clone $citizenQuery)->count();
            $stats['men'] = (clone $citizenQuery)->where('gender', 'Male')->count();
            $stats['women'] = (clone $citizenQuery)->where('gender', 'Female')->count();
            $stats['buddhism'] = (clone $citizenQuery)->where('religion', 'Buddhism')->count();
            $stats['christianity'] = (clone $citizenQuery)->where('religion', 'Christianity')->count();

            // Fetch the actual table data
            $households = \App\Models\Households::where('division_id', $selectedDivisionId)->get();
            $citizens = $citizenQuery->with('household')->get();
        }

        return view('dashboard', compact('divisions', 'stats', 'selectedDivisionId', 'households', 'citizens'));
    }
}