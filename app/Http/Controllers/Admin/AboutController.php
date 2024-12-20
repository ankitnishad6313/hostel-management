<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = About::find(1);
        return view('admin.pages.about', compact('data'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = About::find($id);
        return view('admin.pages.about-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'about_content' => 'required',
            'about_image' => 'mimes:png,jpg,jpeg',
            'mission_content' => 'required',
            'mission_image' => 'mimes:png,jpg,jpeg',
            'message_content' => 'required',
            'message_image' => 'mimes:png,jpg,jpeg',
            'what_we_do_content' => 'required',
            'what_we_do_image' => 'mimes:png,jpg,jpeg',
        ]);

        $data = About::find($id);

        $data->update([
            'about_content' => $request->about_content,
            'about_image' => $this->uploadAboutImage($request, $id),
            'mission_content' => $request->mission_content,
            'mission_image' => $this->uploadMissionImage($request, $id),
            'message_content' => $request->message_content,
            'message_image' => $this->uploadMessageImage($request, $id),
            'what_we_do_content' => $request->what_we_do_content,
            'what_we_do_image' => $this->uploadWhatWeDoImage($request, $id),
        ]);

        return redirect()->route('admin-about-view')->with('success', 'Updated successfully!');

    }

    private function uploadAboutImage(Request $request, $id)
    {
        if ($request->hasFile('about_image')) {
            $image = $request->file('about_image');
            $imageName = time() . 'about_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/about'), $imageName);
            return 'uploads/admin/about/' . $imageName;
        }
        $url = url('/')."/";
        $image = About::find($id)->about_image;
        return str_replace($url,"",$image);
    }

    private function uploadMissionImage(Request $request, $id)
    {
        if ($request->hasFile('mission_image')) {
            $image = $request->file('mission_image');
            $imageName = time() . 'mission_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/about'), $imageName);
            return 'uploads/admin/about/' . $imageName;
        }
        $url = url('/')."/";
        $image = About::find($id)->mission_image;
        return str_replace($url,"",$image);
    }

    private function uploadMessageImage(Request $request, $id)
    {
        if ($request->hasFile('message_image')) {
            $image = $request->file('message_image');
            $imageName = time() . 'message_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/about'), $imageName);
            return 'uploads/admin/about/' . $imageName;
        }

        $url = url('/')."/";
        $image = About::find($id)->message_image;
        return str_replace($url,"",$image);
    }

    private function uploadWhatWeDoImage(Request $request, $id)
    {
        if ($request->hasFile('what_we_do_image')) {
            $image = $request->file('what_we_do_image');
            $imageName = time() . 'what_we_do_image.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/about'), $imageName);
            return 'uploads/admin/about/' . $imageName;
        }

        $url = url('/')."/";
        $image = About::find($id)->what_we_do_image;
        return str_replace($url,"",$image);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
