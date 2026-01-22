<?php

namespace App\Http\Controllers;

use App\Models\Citizens;
use App\Models\Divisions;
use App\Models\Households;
use Illuminate\Http\Request;

class CitizensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $selectedDivision = $request->query('division_id'); // Get selected filter
        
        // Fetch all divisions for the dropdown
        $divisions = \App\Models\Divisions::all();

        $citizens = \App\Models\Citizens::with(['household', 'division'])
            // Filter by Division
            ->when($selectedDivision, function ($query, $selectedDivision) {
                return $query->where('division_id', $selectedDivision);
            })
            // Search by Name or NIC
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('nic', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('full_name')
            ->paginate(10);

        return view('citizens.index', compact('citizens', 'divisions', 'selectedDivision', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $households = Households::all();
        $divisions = Divisions::all();
        return view('citizens.create', compact('households', 'divisions'));
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
            'gender' => 'required|in:Male,Female,Other',
            'religion' => 'required|in:Buddhism,Hinduism,Islam,Christianity,Other',
            'marital_status' => 'required|string',
            'occupation' => 'nullable|string',
            'education_level' => 'nullable|string',
            'income_level' => 'nullable|numeric',
            'samurdhi_status' => 'nullable|boolean',
            'special_notes' => 'nullable|string',
        ]);

        Citizens::create($validated);
        return redirect()->route('citizens.index')->with('success', 'Member added to household.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citizens $citizen)
    {
        // Eager load to show household address and division name
        $citizen->load(['household', 'division']);
        return view('citizens.show', compact('citizen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citizens $citizen)
    {
        $households = Households::all();
        $divisions = Divisions::all();
        return view('citizens.edit', compact('citizen', 'households', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citizens $citizen)
    {
        $validated = $request->validate([
            'household_id' => 'required|exists:households,id',
            'division_id' => 'required|exists:divisions,id',
            'full_name' => 'required|string',
            'nic' => 'nullable|string|unique:citizens,nic,' . $citizen->id,
            'date_of_birth' => 'required|date',
            // Use 'in' instead of 'enum' for simple strings
            'gender' => 'required|in:Male,Female,Other',
            'religion' => 'required|in:Buddhism,Hinduism,Islam,Christianity,Other',
            'marital_status' => 'required|string',
            'occupation' => 'nullable|string',
            'education_level' => 'nullable|string',
            // Use 'numeric' for decimal/money values
            'income_level' => 'nullable|numeric',
            'samurdhi_status' => 'nullable|boolean',
            'special_notes' => 'nullable|string',
        ]);

        $citizen->update($validated);
        return redirect()->route('citizens.index')->with('success', 'Citizen details updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citizens $citizen)
    {
        $citizen->delete();
        return redirect()->route('citizens.index')->with('success', 'Citizen removed.');
    }
}
