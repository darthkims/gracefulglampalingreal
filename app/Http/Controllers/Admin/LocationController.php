<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    // Display a listing of the locations.
    public function index()
    {
        $locations = Location::all();
        return view('admin.locations.index', compact('locations'));
    }

    // Show the form for creating a new location.
    public function create()
    {
        return view('admin.locations.create');
    }

    // Store a newly created location in the database.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Location::create($request->all());

        return redirect()->route('location.index')->with('success', 'Location created successfully!');
    }

    // Display the specified location.
    public function show(Location $location)
    {
        return view('admin.locations.show', compact('location'));
    }

    // Show the form for editing the specified location.
    public function edit($id)
    {
        $location = Location::findOrFail($id);
        
        return view('admin.locations.edit', compact('location'));
    }

    // Update the specified location in the database.
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $location->update($request->all());

        return redirect()->route('location.index')->with('success', 'Location updated successfully!');
    }

    // Remove the specified location from the database.
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('location.index')->with('success', 'Location deleted successfully!');
    }
}
