<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class AgentOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = User::where('role', 'owner')->where('added_by', auth()->user()->id)->get();
        return view('agent.owner.list', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agent.owner.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|unique:users,phone|min:10|max:10',
            'email' => 'required|email|unique:users,email|max:100',
            'gender' => 'required',
            'address' => 'required|max:150',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make(123456);
        $user->address = $request->address;
        $user->image = $this->uploadProfileImage($request);
        $user->role = "owner";
        $user->added_by = auth()->user()->id;

        if($user->save()){
            return redirect()->route('agent-list-owner')->with('success', 'Owner Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Owner not Added!');
        }
    }

    private function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/owner'), $imageName);
            return 'uploads/owner/' . $imageName;
        }

        return NULL;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return view('agent.owner.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $owner = User::find($id);
        return view('agent.owner.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|min:10|max:10|unique:users,phone,'.$id,
            'email' => 'required|email|max:100|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'gender' => 'required',
            'status' => 'required',
            'address' => 'required|max:150',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->status = $request->status;
        if((trim($request->password) != NULL) || (trim($request->password) != "")){
            $user->password = $request->password;
        }
        $user->address = $request->address;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/owner'), $imageName);
            $user->image = 'uploads/owner/' . $imageName;
        }

        if($user->save()){
            return redirect()->route('agent-list-owner')->with('success', 'Owner Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Owner not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with("success", "Moved to Trashed!");
    }
}
