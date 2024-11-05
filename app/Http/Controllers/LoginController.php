<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm(){
        $data = "Welcome!";

        return view("login")->with('data', $data);
        //OR return view('login', ['data' => $data]);
    }

    public function handleLogin(Request $request)
    {
        try{
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
            $remember = $request->has('remember');

            if(Auth::attempt($credentials, $remember)){
                $request->session()->regenerate();

                return redirect()->route('home')->with('success', 'Login successful');
            }else{
                return redirect('/login')->with('error', 'Credentials didn\'t match');
            }
            //dd($request->all());

        } catch(\Exception $e){
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function showHome()
    {
        try{
            //$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

            //Auth::check();
            //$users = User::all();
            $user = Auth::user();

            return view('home',['user' => $user] );

        }catch(\Exception $e){
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }
}
