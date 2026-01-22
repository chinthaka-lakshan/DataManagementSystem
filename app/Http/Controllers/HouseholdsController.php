<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use App\Models\Households;
use App\Models\Citizens;
use Illuminate\Http\Request;

class HouseholdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $households = Households::with('division')->get();
    return view('households.index', compact('households'));
}

    /**
     * Show the form for creating a new resource.
     * THIS FIXES THE divisions.create ERROR
     */
    public function create()
    {
        $divisions = Divisions::all();
        return view('households.create', compact('divisions'));
    }
    /**
     * Store a newly created resource in storage.
     * THIS ENABLES THE divisions.store ROUTE
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'house_number' => 'required|unique:households',
            'address' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'head_of_household' => 'required|string',
        ]);

        Households::create($validated);
        return redirect()->route('households.index')->with('success', 'Household added.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Households $household)
    {
        $divisions = Divisions::all();
        return view('households.edit', compact('household', 'divisions'));
    }
    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        return redirect()->route('households.index');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Households $household)
    {
        $validated = $request->validate([
            'house_number' => 'required|unique:households,house_number,' . $household->id,
            'address' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'head_of_household' => 'required|string',
        ]);

        $household->update($validated);
        return redirect()->route('households.index')->with('success', 'Household updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Households $household)
    {
        $household->delete();
        return redirect()->route('households.index')->with('success', 'Household deleted.');
    }
}