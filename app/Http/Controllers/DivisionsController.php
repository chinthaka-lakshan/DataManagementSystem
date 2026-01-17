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
        $divisions = Divisions::all(); // Fetches all records from the DB
        return response()->view('divisions.index', [
            'divisions' => $divisions, // Passes data to the Blade view
        ]);
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

        Division::create($validated);

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
    public function edit(Divisions $divisions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisions $divisions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisions $divisions)
    {
        //
    }
}
