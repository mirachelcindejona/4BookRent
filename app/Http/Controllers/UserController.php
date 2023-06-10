<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->where('status', 'active')->get();
        return view('users', ['users' => $users]);
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('user-detail', ['user' => $user, 'rent_logs' => $rentlogs]);
    }

    public function registeredUsers()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('registered-users', ['registeredUsers' => $registeredUsers]);
    }

    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();

        return redirect('users')->with('status', 'User Approved Successfully');
    }

    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        return redirect('users')->with('status', 'User Banned Successfully');
    }

    public function bannedUsers()
    {
        $bannedUsers = User::onlyTrashed()->get();
        return view('users-banned', ['bannedUsers' => $bannedUsers]);
    }

    public function restore($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        return redirect('users')->with('status', 'User Restored Successfully');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function editProfile($slug, Request $request)
    {
        $validated = $request->validate([
            'username' => 'max:255',
            'phone' => 'max:255',
        ]);
        
        $user = User::where('slug', $slug)->first();
        $user->slug = null;
        $user->update($request->all());

		return redirect('profile')->with('status', 'Profile Updated Successfully');
    }

    public function editPassword($slug, Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|max:255',
        ]);
        
        $request['password'] = Hash::make($request->password);
        $user = User::where('slug', $slug)->first();
        $user->update($request->all());

		return redirect('profile')->with('status', 'Password Changed Successfully');
    }

    public function rentLogUser()
    {
        $user = Auth::user();
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', $user->id)->get();
        return view('rentlog-user', ['user' => $user, 'rent_logs' => $rentlogs]);
    }
}