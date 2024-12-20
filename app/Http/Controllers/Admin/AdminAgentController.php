<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use App\Models\Hostel;
use Hash;
use Illuminate\Http\Request;

class AdminAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = User::where('role', 'agent')->get();
        return view('admin.agent.list', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agent.add');
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
        $user->role = "agent";

        if($user->save()){
            return redirect()->route('admin-list-agent')->with('success', 'Agent Added Successfully!');
        }else{
            return redirect()->back()->with('error', 'Agent not Added!');
        }
    }

    private function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/agent'), $imageName);
            return 'uploads/agent/' . $imageName;
        }

        return NULL;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $user = User::find($id);
        $documents = Document::where('user_id', $id)->get();
        $hostels = Hostel::where('agent_id', $id)->get();
        return view('admin.agent.view', compact('user', 'documents', 'hostels'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agent = User::find($id);
        return view('admin.agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => "required|min:10|max:10|unique:users,phone,$id",
            'email' => "required|email|max:100|unique:users,email,$id",
            'password' => 'nullable|min:6',
            'gender' => 'required',
            // 'status' => 'required',
            'address' => 'required|max:150',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->gender = $request->gender;
        if($request->status){
            $user->status = $request->status;
        }
        if((trim($request->password) != NULL) || (trim($request->password) != "")){
            $user->password = $request->password;
        }
        $user->address = $request->address;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/agent'), $imageName);
            $user->image = 'uploads/agent/' . $imageName;
        }

        if($user->save()){
            return redirect()->route('admin-list-agent')->with('success', 'Agent Updated Successfully!');
        }else{
            return redirect()->back()->with('error', 'Agent not Updated!');
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
