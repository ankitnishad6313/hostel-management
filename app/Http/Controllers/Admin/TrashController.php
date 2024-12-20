<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hostel;
use App\Models\PopularHostel;
use App\Models\User;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function trashData(){
        $data['users'] = User::onlyTrashed()->get();
        $data['popular'] = PopularHostel::with('hostel','user')->onlyTrashed()->get();
        $data['hostel'] = Hostel::with('user')->onlyTrashed()->get();
        // dd($data);
        return view('admin.trash', compact('data'));
    }
    public function restoreUser($id){
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->route('trash')->with('success', 'User Restored Succssfully!');
    }
    public function deleteUser($id){
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('trash')->with('success', 'User Deleted Succssfully!');
    }
    public function restoreHostel($id){
        $hostel = Hostel::withTrashed()->find($id);
        $hostel->restore();
        return redirect()->route('trash')->with('success', 'Hostel Restored Succssfully!');
    }
    public function deleteHostel($id){
        $hostel = Hostel::withTrashed()->find($id);
        $hostel->forceDelete();
        return redirect()->route('trash')->with('success', 'Hostel Deleted Succssfully!');
    }

    // Popular Hostels
    public function restorePopularHostel($id){
        $hostel = PopularHostel::withTrashed()->find($id);
        $hostel->restore();
        return redirect()->route('trash')->with('success', 'Popular Hostel Restored Succssfully!');
    }
    public function deletePopularHostel($id){
        $hostel = PopularHostel::withTrashed()->find($id);
        $hostel->forceDelete();
        return redirect()->route('trash')->with('success', 'Popular Hostel Deleted Succssfully!');
    }
}
