<?php

namespace App\Http\Controllers;

use App\Models\Citizens;
use Illuminate\Http\Request;

class CitizensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citizens = Citizens::all();

        return view('citizens.index', [
            'citizens' => $citizens,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('citizens.create');
        $divisions = Divisions::all();
        return view('citizens.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'household_id' => 'required|exists:households,id',
            'division_id' => 'required|exists:divisions,id',
            'full_name' => 'required|string',
            'nic' => 'nullable|string|unique:citizens,nic',
            'date_of_birth' => 'required|date',
            'gender' => 'required|enum:Male,Female,Other',
            'religion' => 'required|enum:Buddhism,Hinduism,Islam,Christianity,Other',
            'marital_status' => 'required|string',
            'occupation' => 'nullable|string',
            'education_level' => 'nullable|string',
            'income_level' => 'nullable|decimal',
            'samurdhi_status' => 'nullable|boolean',
            'special_notes' => 'nullable|string',
        ]);

        Citizen::create($validated);
        return redirect()->route('citizens.index')->with('success', 'Member added to household.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizens $citizens)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citizens $citizens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citizens $citizens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizens $citizens)
    {
        //
    }
}
