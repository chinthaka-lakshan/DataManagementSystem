<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Access as a property to get the Collection of divisions
        $divisions = auth()->user()->divisions; 

        return view('divisions.index', compact('divisions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'division_code' => 'required|unique:divisions|max:50',
            'division_name' => 'required|string|max:255',
            'divisional_secretariat' => 'required|string|max:255',
        ]);

        auth()->user()->divisions()->create($validated);

        return redirect()->route('divisions.index')
                         ->with('success', 'GN Division created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisions $divisions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisions $division)
    {
        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisions $division)
    {
        $validated = $request->validate([
            'division_code' => 'required|max:50|unique:divisions,division_code,' . $division->id,
            'division_name' => 'required|string|max:255',
            'divisional_secretariat' => 'required|string|max:255',
        ]);

        $division->update($validated);

        return redirect()->route('divisions.index')
                         ->with('success', 'GN Division updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisions $divisions)
    {
        //
    }
}
