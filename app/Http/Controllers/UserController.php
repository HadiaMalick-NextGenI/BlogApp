<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // $request->validate(
        //     [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8',
        //     'phone' => 'nullable|string|max:15',
        //     'dob' => 'nullable|date',
        //     'age' => 'nullable|integer|min:0', 
        //     'city' => 'nullable|string|max:255',
        //     'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        //     'roles' => 'required', 
        //     ]
        // );
        
        $path = $request['profile_picture']->store('profile_pictures', 'public');
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'dob' => $request->dob,
            'age' => $request->age,
            'city' => $request->city,
            'profile_picture' => $path,
        ]);
        
        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->getRoleNames()->toArray();

        return view('users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try{
            if ($request->hasFile('profile_picture')) {
                $path = $request->file('profile_picture')->store('profile_pictures', 'public');
           
                $user->profile_picture = $path;
            }
            
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'dob' => $request->input('dob'),
                'age' => $request->input('age'),
                'city' => $request->input('city'),
            ]);
            
            $user->save();
            
            return redirect()->route('users.index')->with('success', 'User info updated successfully.');
            
        } catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User account deleted successfully.');
    }
}
