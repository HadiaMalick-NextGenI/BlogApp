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
        $users = User::simplePaginate(5);
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
        try{
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
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'An error occured while creating user '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('blogs');
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
            
            $user->syncRoles($request->roles);
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
