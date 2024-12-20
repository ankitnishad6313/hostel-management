<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Hostel;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $user = Auth::user();
        $data['owner'] = User::where('role', 'owner')->get()->count();
        $data['agent'] = User::where('role', 'agent')->get()->count();
        $data['hostel'] = Hostel::all()->count();
        $data['enquiry'] = Enquiry::all()->count();
        $data['booking'] = Booking::all()->count();
        $data['student'] = User::where('role', 'student')->get()->count();
        $data['total_boys'] = User::where('role', 'student')->where('gender', 'Male')->get()->count();
        $data['total_girls'] = User::where('role', 'student')->where('gender', 'Female')->get()->count();
        $data['recent_bookings'] = Booking::with('user', 'hostel')->where('created_at', '<=', now()->subDays(7))->orderBy('id', 'desc')->limit(30)->get();
        $data['hostels'] = Hostel::with('user')->where('created_at', '>=', now()->subDays(7))->orderBy('id', 'desc')->limit(20)->get();
        $data['enquiries'] = Enquiry::with('user')->where('created_at', '>=', now()->subDays(7))->orderBy('id', 'desc')->paginate(10);
        // dd($data);
        return view("admin.dashboard", compact("user", "data"));
    }

    public function profile(){
        $user = Auth::user();
        return view("admin.profile", compact("user"));
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

        return redirect()->route('admin-profile')->with('success', 'Profile updated successfully!');
        
    }

    private function uploadProfileImage(Request $request)
    {
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/admin/profile_images'), $imageName);
            return 'uploads/admin/profile_images/' . $imageName;
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
        return redirect()->route('admin-profile')->with('success', 'Password changed successfully.');
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
        
        return redirect()->route('admin-profile')->with('success', 'Profile Picture Deleted successfully!');
    }

}
