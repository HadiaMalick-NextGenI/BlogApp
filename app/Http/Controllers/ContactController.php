<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected $emailController;

    public function __construct(EmailController $emailController)
    {
        $this->emailController = $emailController;
    }
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'subject' => 'required|string|max:100',
                'message' => 'required|string',
                'file' => 'nullable|file|mimes:jpg,png,pdf,docx,doc,xls,xlsx|max:2048',
            ]);
    
            $filePath = $request->file('file') ? $request->file('file')->store('contact_files', 'public') : null;
    
            $this->emailController->sendContactEmail($request->only('name', 'email', 'subject', 'message'), $filePath);
            
            return back()->with('success', 'Your message has been sent successfully!');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
