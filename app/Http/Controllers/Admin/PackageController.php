<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\Package;
use App\Models\User;
use File;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $owners = User::select('id', 'name', 'phone')
            ->whereIn('role', ['admin', 'owner'])
            ->get();
        return view('admin.package.list', compact('packages', 'owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.package.add');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'package' => 'required|string|max:100',
            'price' => 'required',
            'validity' => 'required',
            'content' => 'required'
        ]);

        $package = new Package;
        $package->create([
            'package' => ucwords($request->package),
            'price' => $request->price,
            'validity' => $request->validity,
            'content' => $request->content,
        ]);

        return redirect()->route('admin-list-package')->with('success', 'Package added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.package.view');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $package = Package::find($id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'package' => 'required|string|max:100',
            'price' => 'required',
            'validity' => 'required',
            'content' => 'required'
        ]);

        $package = Package::find($id);
        $package->update([
            'package' => ucwords($request->package),
            'price' => $request->price,
            'validity' => $request->validity,
            'content' => $request->content,
        ]);

        return redirect()->route('admin-list-package')->with('success', 'Package Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::find($id);
        $package->delete();
        return redirect()->back()->with('success', 'Package Deleted successfully!');
    }

}
