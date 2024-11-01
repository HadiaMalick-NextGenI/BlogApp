<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(User $user){
        $message = "Hello {$user->name}, welcome to our website";
        $ccUser = "hadia.malick@nextgeni.com";
        $subject = "Welcome to blog app";
        $details = [
            'product' => "Bag",
            'price' => 2000,
        ];
        $picture = $user->profile_picture;

        Mail::to($user->email)->cc($ccUser)
            ->send(new WelcomeEmail($message, $subject, $details, $picture));
    }
}
