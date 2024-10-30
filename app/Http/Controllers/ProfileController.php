<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); 
        return view('profile.edit', compact('user')); 
    }

    public function update(UserRequest $request, User $user)
    {
        try{
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->dob = $request->input('dob');
            $user->age = $request->input('age');
            $user->city = $request->input('city');

            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
                $user->profile_picture = $path;
            }

            $user->save();

            return redirect()->route('home')
                ->with('success', 'Profile updated successfully.');

        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
