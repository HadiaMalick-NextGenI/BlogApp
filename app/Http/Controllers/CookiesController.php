<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookiesController extends Controller
{
    public function showView(Request $request)
    {
        $language = $request->cookie('user_language', 'English'); 

        return view('cookie_example', compact('language'));
    }

    public function setCookie(Request $request){
        $request->validate([
            'language' => 'required|string|max:255'
        ]);
        $language = $request->input('language');
        $cookie = cookie('user_language', $language, 60); 

        return redirect()->route('show-view')->cookie($cookie);
    }

    public function getCookie(Request $request)
    {
        $language = $request->cookie('user_language');

        return response("The user's language preference is: " . $language);
    }
    public function deleteCookie()
    {
        $cookie = Cookie::forget('user_language');

        return response("Cookie has been deleted.")->withCookie($cookie);
    }

    public function setLongTermCookie()
    {
        // Setting a cookie with a 1-year expiration time
        $cookie = cookie('user_id', '12345', 60 * 24 * 365);

        return response("Long-term cookie has been set.")->cookie($cookie);
    }
}

