<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $divisions = auth()->user()->divisions;

        $divisions = auth()->user()->divisions; 
        return view('divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 🔴 Block access if limit reached
        if (auth()->user()->divisions()->count() >= 3) {
            return redirect()->route('divisions.index')
                ->with('error', 'You have reached the maximum limit of 3 divisions.');
        }

        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // 🔴 LIMIT CHECK
        if ($user->divisions()->count() >= 3) {
            return redirect()->back()
                ->with('error', 'You can only create up to 3 divisions.');
        }

        // ✅ Validation
        $validated = $request->validate([
            'division_code' => 'required|unique:divisions|max:50',
            'division_name' => 'required|string|max:255',
            'divisional_secretariat' => 'required|string|max:255',
        ]);

        // ✅ Save
        $user->divisions()->create($validated);

        return redirect()->route('divisions.index')
            ->with('success', 'GN Division created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisions $division)
    {
        // 🔒 Ownership check
        if ($division->user_id !== auth()->id()) {
            abort(403);
        }

        return view('divisions.show', compact('division'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisions $division)
    {
        // 🔒 Ownership check
        if ($division->user_id !== auth()->id()) {
            abort(403);
        }

        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisions $division)
    {
        // 🔒 Ownership check
        if ($division->user_id !== auth()->id()) {
            abort(403);
        }

        // ✅ Validation
        $validated = $request->validate([
            'division_code' => 'required|max:50|unique:divisions,division_code,' . $division->id,
            'division_name' => 'required|string|max:255',
            'divisional_secretariat' => 'required|string|max:255',
        ]);

        // ✅ Update
        $division->update($validated);

        return redirect()->route('divisions.index')
            ->with('success', 'GN Division updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisions $division)
    {
        // 🔒 Ownership check
        if ($division->user_id !== auth()->id()) {
            abort(403);
        }

        $division->delete();

        return redirect()->route('divisions.index')
            ->with('success', 'GN Division deleted successfully!');
    }
}