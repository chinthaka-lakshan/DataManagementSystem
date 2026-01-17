<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::all();
        return view('divisions.index', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     * THIS FIXES THE divisions.create ERROR
     */
    public function create()
    {
        return view('divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     * THIS ENABLES THE divisions.store ROUTE
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
                         ->with('success', 'GN Division added successfully.');
    }
}