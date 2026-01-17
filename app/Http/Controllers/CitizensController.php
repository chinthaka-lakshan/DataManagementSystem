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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
