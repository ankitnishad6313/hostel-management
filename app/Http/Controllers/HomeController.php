<?php

namespace App\Http\Controllers;

use App\Mail\{WelcomeMail, SendOtpMail, PasswordChangedMail};
use App\Models\{Bed, SiteSetting, User};
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Session;

class HomeController extends Controller
{
    public function checking(){
        return assignFreePackagetoHostel(4);
    }
    public function registerView(){
        return view('register');
    }


    public function loginView(Request $request){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        
        if(Auth::guard('web')->attempt($credentials)){
            $role = Auth::user()->role;
            if($role == "student"){
                return redirect()->back()->with('error', 'You are not Authorized to Login');
            }else{
                return redirect("$role/dashboard")->with('success', 'Logged in successfully.');
            }
        }
        return redirect()->back()->with('error', 'Invalid Password.');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'string|required|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:10|max:10|unique:users,phone',
            'gender' => 'required|string|in:Male,Female',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:6|max:15',
            'confirm_password' => 'required|same:password',
            'address' => 'required|max:150',
            'terms' => 'required',
        ]);

        $owner = new User;
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->phone = $request->phone;
        $owner->gender = $request->gender;
        $owner->password = Hash::make($request->password);
        $owner->address = $request->address;
        $owner->image = $this->uploadProfileImage($request);
        $owner->role = 'owner';
        if($owner->save()){
            $mailData= [
                'title' => 'Thank for Registration',
                'subject' => 'Welcome to NearMeHostel',
                'name' => $request->name,
            ];
            Mail::to("$request->email")->send(new WelcomeMail($mailData));
            return redirect('/')->with('success', 'Registration Successfull!!');
        }else{
            return redirect()->back()->with('error', 'Something went Wrong!!');
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

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('/')->with('success', 'Logout successfully.');
    }
    public function forgotPassword(){
        return view('forget-password');
    }
    public function sendOtp(Request $request){
        $request->validate(['email' => 'required|email|exists:users,email']);
        $otp = rand(111111,999999);
        Session::put('step', 2);
        Session::put('otp', $otp);
        Session::put('email', $request->email);
        $user = User::where('email', $request->email)->first();
        $admin = User::where('role', 'admin')->first();
        $site = SiteSetting::find(1);
        $mailData = [
            'otp' => $otp,
            'subject' => 'Your One-Time Password (OTP) for NearMeHostel Account Recovery',
            'name' => $user->name,
            'owner' => $admin->name,
            'site_name' => $site->site_name,
            'email' => $site->email,
            'mobile' => $site->mobile,
        ];
        Mail::to("$request->email")->send(new SendOtpMail($mailData));
        return redirect('/forget-password')->with('success', 'OTP Sent Successfully');
    }
    public function verifyOtp(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric:digits:6'
        ]);
        if((Session::get('email') == $request->email) && (Session::get('otp') == $request->otp)){
            Session::put('step', 3);
            return redirect('forget-password')->with('success', 'OTP Verified Successfully');
        }else{
            return redirect()->back()->with('error', 'Invalid OTP.');
        }
    }

    public function changePassword (Request $request){
        $request->validate([
            'password' => 'required|min:6|max:6',
            'confirm_password' => 'required|same:password|min:6|max:6'
        ]);

        $email = Session::get('email');
        $user = User::where('email', $email)->first();

        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->invalidate();
        $admin = User::where('role', 'admin')->first();
        $site = SiteSetting::find(1);
        $mailData = [
            'subject' => 'Password Changed Successfully - NearMeHostel Account',
            'name' => $user->name,
            'owner' => $admin->name,
            'site_name' => $site->site_name,
            'email' => $site->email,
            'mobile' => $site->mobile,
        ];
        Mail::to("$email")->send(new PasswordChangedMail($mailData));
        return redirect('/')->with('success', 'Password Changed Successfully');
    }
}
