<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {

        $drivers = Driver::latest()->paginate(10);
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);


        Driver::create($request->all());
        LogHelper::add('create_driver', 'Membuat driver dengan nama : ' . $request->name);

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $driver->update($request->all());
        LogHelper::add('update_driver', 'Memperbarui driver dengan nama : ' . $request->name);

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil diupdate.');
    }

    public function destroy(Driver $driver)
    {
        $driver->delete();
        LogHelper::add('delete_driver', 'Menghapus driver dengan nama : ' . $driver->name);

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil dihapus.');
    }
}
