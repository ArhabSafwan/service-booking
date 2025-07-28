<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Show services (customer)
    public function index()
    {
        return Service::where('status', true)->get();
    }

    // Admin: Create service
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        return Service::create($request->all());
    }

    // Admin: Update
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());

        return $service;
    }

    // Admin: Delete
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
