<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Hostel;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Hash;
use Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $data['owners'] = User::where('role', 'owner')->where('added_by', $user->id)->orderBy('id', 'desc')->get();
        $data['hostels'] = Hostel::with('user')->where('agent_id', $user->id)->orderBy('id', 'desc')->get();
        return view("agent.dashboard", compact("user", 'data'));
    }
    public function profile(){
        $user = Auth::user();
        $documents = Document::where('user_id', $user->id)->get();
        return view("agent.profile", compact("user", "documents"));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|min:10|max:10|unique:users,phone,'. Auth::user()->id,
            'dob' => 'required',
            'country' => 'required',
            'address' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        $user->update([
            'name' => ucfirst($request->name),
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'image' => $this->uploadProfileImage($request),
            'country' => $request->country,
            'about' => $request->about,
            'address' => $request->address,
            'twitter' => ($request->twitter == "") ? NULL : "$request->twitter",
            'facebook' => ($request->facebook == "") ? NULL : "$request->facebook",
            'instagram' => ($request->instagram == "") ? NULL : "$request->instagram",
            'linkedin' => ($request->linkedin == "") ? NULL : "$request->linkedin",
        ]);

        return redirect()->route('agent-profile')->with('success', 'Profile updated successfully!');
        
    }

    private function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/agent'), $imageName);
            return 'uploads/agent/' . $imageName;
        }
        $url = url('/')."/";
        $image = Auth::user()->image;
        return str_replace($url,"",$image);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|different:current_password',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Incorrect current password.']);
        }

        // Update the user's password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('agent-profile')->with('success', 'Password changed successfully.');
    }

    public function deleteProfileImage(){
        $user = Auth::user();
        if ($user->image) {
            $picturePath = $user->image;

            if (File::exists($picturePath)) {
                File::delete($picturePath);
            }

            $user->image = null;
            $user->save();
        }
        
        return redirect()->route('agent-profile')->with('success', 'Profile Picture Deleted successfully!');
    }
}
