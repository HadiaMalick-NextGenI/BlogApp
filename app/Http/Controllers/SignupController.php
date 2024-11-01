<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    protected $emailController;

    public function __construct(EmailController $emailController)
    {
        $this->emailController = $emailController;
    }

    public function showSignupForm()
    {
        return view('signup');
    }

    public function register(UserRequest $request)
    {
        try{
            if($request['profile_picture']){
                $path = $request['profile_picture']->store('profile_pictures', 'public');
            }
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'dob' => $request->dob,
                'age' => $request->age,
                'city' => $request->city,
                'profile_picture' => $path?? null,
            ]);

            $user->assignRole($request->input('roles'));

            $this->emailController->sendEmail($user);
            
            //$user->assignRole('user');
    
            return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');

        }catch(\Exception $e){
            //dd($e->getMessage());
            return redirect()->route('signup')->with('error', $e->getMessage());
        }
        
    }
}
