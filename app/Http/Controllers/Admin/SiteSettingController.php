<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = SiteSetting::find(1);
        return view('admin.sitesettings.setting', compact('setting'));
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $setting = SiteSetting::find(1);
        $setting->site_name = $request->site_name;
        $setting->mobile = $request->mobile;
        $setting->mobile_second = $request->mobile_second;
        $setting->email = $request->email;
        $setting->email_second = $request->email_second;
        $setting->address = $request->address;
        $setting->about_site = $request->about_site;
        if($request->hasFile('logo')){
            $img = $request->file('logo');
            $name = time() . rand(1111,999) . $img->getClientOriginalName();
            $imgname = 'uploads/sitesetting/' . $name;
            $img->move(public_path('uploads/sitesetting'), $imgname);
            $setting->logo = $imgname;
        }

        if($request->hasFile('favicon')){
            $img = $request->file('favicon');
            $name = time() . rand(1111,999) . $img->getClientOriginalName();
            $imgname = 'uploads/sitesetting/' . $name;
            $img->move(public_path('uploads/sitesetting'), $imgname);
            $setting->favicon = $imgname;

        }

        $setting->save();

        return redirect()->back()->with('success', 'Details Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
