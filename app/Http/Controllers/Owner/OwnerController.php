<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Document, Enquiry, Hostel};
use Illuminate\Support\Facades\File;
use Hash;
use Auth;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $data['hostels'] = Hostel::where('user_id', $user->id)->count();
        $data['enquiries_count'] = Enquiry::where('user_id', $user->id)->count();
        $data['enquiries'] = Enquiry::where('user_id', $user->id)->where('created_at', '>=', now()->subDays(7))->orderBy('id', 'desc')->paginate(10);
        $data['students'] = Booking::with('hostel', 'user')->where('check_out_date', ">=", now())->where('owner_id', $user->id)->get();
        $data['recent_hostels'] = Hostel::where('user_id', $user->id)->where('created_at', '>=', now()->subDays(7))->get();
        $data['recent_bookings'] = Booking::with('user', 'hostel')->where('check_out_date', ">=", now())->where('owner_id', $user->id)->where('created_at', '>=', now()->subDays(7))->orderBy('id', 'desc')->limit(30)->get();
        $data['notifications'] = Booking::with('hostel', 'user')->where('owner_id', $user->id)->where('check_out_date', '<=', now())->where('created_at', '>=', now()->subDays(7))->orderBy('id', 'desc')->paginate(5);
        return view("owner.dashboard", compact("user", "data"));
    }

    public function profile(){
        $user = Auth::user();
        $documents = Document::where('user_id', $user->id)->get();
        return view("owner.profile", compact("user", "documents"));
    }

    public function updateProfile(Request $request){
        $id = Auth::user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|digits:10|unique:users,phone,'. $id,
            'dob' => 'required',
            'country' => 'required',
            'address' => 'required|max:150',
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
            'twitter' => ($request->twitter == "") ? NULL : $request->twitter,
            'facebook' => ($request->facebook == "") ? NULL : $request->facebook,
            'instagram' => ($request->instagram == "") ? NULL : $request->instagram,
            'linkedin' => ($request->linkedin == "") ? NULL : $request->linkedin,
        ]);
        return redirect()->route('owner-profile')->with('success', 'Profile updated successfully!');
    }

    private function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/owner/profile_images'), $imageName);
            return 'uploads/owner/profile_images/' . $imageName;
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
        return redirect()->route('owner-profile')->with('success', 'Password changed successfully.');
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
        
        return redirect()->route('owner-profile')->with('success', 'Profile Picture Deleted successfully!');
    }
}
