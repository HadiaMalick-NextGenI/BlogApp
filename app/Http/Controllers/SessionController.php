<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(){
        $value = session('name');
        return view('welcome', compact('value'));

        // $value = session()->all();
        // echo "<pre>";
        // print_r($value);
        // echo "</pre>";

        //$value = session()->get('name'); OR
        // $value = session('name');
        // echo $value;

        //return view('welcome');
    }

    public function storeSession(Request $request){

        //With Request Class
        // $request->session(['name' => 'Hadia Malick']); //won't work with request
        // $request->session()->put('name', 'Hadia Malick');
        // $request->session()->put('key', 'value');

        //Global session
        // session(['name' => 'Hadia Malick']);
        // session()->put('key', 'value');
        session([
            'name' => 'Hadia Malick',
            'key' => 'value'
        ]);

        session()->flash('status', 'Session created successfully!');

        return redirect('/');
    }

    public function deleteSession(){
        session()->forget(['name', 'key']);
        return redirect('/');
    }
}
