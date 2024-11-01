<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
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

    public function sendContactEmail(array $data, $filePath)
    {
        $toEmail = "hadia.malick@nextgeni.com";
        $name = $data['name'];
        $email = $data['email'];
        $subject = $data['subject'];
        $messageContent = $data['message'];

        Mail::to($toEmail)->send(new ContactEmail($name, $email, $subject, $messageContent, $filePath));
    }
}
