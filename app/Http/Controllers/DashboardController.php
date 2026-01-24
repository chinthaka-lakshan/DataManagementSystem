<?php

namespace App\Http\Controllers;

use App\Models\Divisions; 
use App\Models\Citizens;   // Using the plural model name you created
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // 1. Fetch ONLY divisions belonging to the authenticated user
        $divisions = auth()->user()->divisions;
        
        // 2. Extract the IDs to prevent unauthorized data access via URL manipulation
        $userDivisionIds = $divisions->pluck('id');

        $selectedDivisionId = $request->query('division_id');

        $stats = [
            'total' => 0, 'men' => 0, 'women' => 0,
            'buddhism' => 0, 'christianity' => 0
        ];

        $households = collect();
        $citizens = collect();

        // 3. Check if a division is selected AND if it belongs to the user
        if ($selectedDivisionId && $userDivisionIds->contains($selectedDivisionId)) {
            
            $citizenQuery = Citizens::where('division_id', $selectedDivisionId);
            
            // Fetch stats for the specific division
            $stats['total'] = (clone $citizenQuery)->count();
            $stats['men'] = (clone $citizenQuery)->where('gender', 'Male')->count();
            $stats['women'] = (clone $citizenQuery)->where('gender', 'Female')->count();
            $stats['buddhism'] = (clone $citizenQuery)->where('religion', 'Buddhism')->count();
            $stats['christianity'] = (clone $citizenQuery)->where('religion', 'Christianity')->count();

            // Fetch the table data
            $households = \App\Models\Households::where('division_id', $selectedDivisionId)->get();
            $citizens = $citizenQuery->with('household')->get();
            
        } elseif (!$selectedDivisionId) {
            // OPTIONAL: Show global stats for ALL of this user's divisions combined
            $globalQuery = Citizens::whereIn('division_id', $userDivisionIds);
            
            $stats['total'] = (clone $globalQuery)->count();
            $stats['men'] = (clone $globalQuery)->where('gender', 'Male')->count();
            $stats['women'] = (clone $globalQuery)->where('gender', 'Female')->count();
            $stats['buddhism'] = (clone $globalQuery)->where('religion', 'Buddhism')->count();
            $stats['christianity'] = (clone $globalQuery)->where('religion', 'Christianity')->count();
        }

        return view('dashboard', compact('divisions', 'stats', 'selectedDivisionId', 'households', 'citizens'));
    }
}