<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Helpers\LogHelper;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(10);
        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'ownership' => 'required|in:company,rental',
        ]);

        Vehicle::create($request->all());

        LogHelper::add('create_vehicle', 'Membuat kendaraan dengan nama : ' . $request->name);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $vehicle->id,
            'ownership' => 'required|in:company,rental',
        ]);

        $vehicle->update($request->all());

        LogHelper::add('update_vehicle', 'Mengubah kendaraan dengan nama : ' . $request->name);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil diubah.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicleName = $vehicle->name;
        $vehicle->delete();

        LogHelper::add('delete_vehicle', 'Menghapus kendaraan dengan nama : ' . $vehicleName);

        return redirect()->route('vehicles.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
