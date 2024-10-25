<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function showHome()
    {
        $numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
        $users = User::all();
        return view('home', ['numbers'=> $numbers , 'users' => $users]);
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return view('login');
    }
}
