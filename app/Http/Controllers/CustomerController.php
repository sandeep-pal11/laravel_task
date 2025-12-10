<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CustomerController extends Controller
{
    // Profile Page Show
    public function profile()
    {
        return view('customer.profile', [
            'user' => Auth::user(),
            'countries' => Country::all(),
            'states' => State::all(),
            'cities' => City::all(),
        ]);
    }

    // Update Profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:50',
            'last_name'    => 'required|string|max:50',
            'phone_number' => 'required|digits:10',
            'country_id'   => 'required',
            'state_id'     => 'required',
            'city_id'      => 'required',
            'profile_img'  => 'nullable|image|max:2048'
        ]);

        // FIXED LINE
        $user = User::find(Auth::id());

        // Update image if uploaded
        if ($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('storage/profile'), $imageName);
            $user->profile_img = $imageName;
        }

        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->country_id   = $request->country_id;
        $user->state_id     = $request->state_id;
        $user->city_id      = $request->city_id;

        $user->save();

        return back()->with('success', 'Profile Updated Successfully!');
    }

    // Update Password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        //  FIXED LINE
        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect!');
        }

        $user->password = Hash::make($request->password);
        $user->save();  

        return back()->with('success', 'Password Updated Successfully!');
    }
}
