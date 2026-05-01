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
    public function index(Request $request)
    {
        if (auth()->user()->role === 'admin') {
            $gnUsers = \App\Models\User::where('role', 'user')->get();
            $selectedGnUserId = $request->query('gn_user_id');

            $divisions = Divisions::with('user')
                ->when($selectedGnUserId, function ($query, $selectedGnUserId) {
                    return $query->where('user_id', $selectedGnUserId);
                })
                ->get();

            return view('divisions.index', compact('divisions', 'gnUsers', 'selectedGnUserId'));
        }

        $divisions = auth()->user()->divisions; 
        return view('divisions.index', compact('divisions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized action.');
        }

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
        if (auth()->user()->role !== 'user' || $division->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('divisions.edit', compact('division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Divisions $division)
    {
        if (auth()->user()->role !== 'user' || $division->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

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
