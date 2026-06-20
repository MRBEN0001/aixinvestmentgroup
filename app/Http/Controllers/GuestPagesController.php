<?php

namespace App\Http\Controllers;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

use App\Mail\ContactUs;

class GuestPagesController extends Controller
{
    public function aboutIndex()

    { 
        // Returns the "about" Blade view
        return view('about-us' , ['pageName' => 'About Us']);
    }
    
 
    
    public function planIndex()

    { 
        // Returns the "plan" Blade view

         // Fetch all plans from the database
         $plans = Plan::all(); 

         // Pass the plans data to the 'plan' view
        return view('plan' , ['pageName' => 'Plan'], compact('plans'));
    } 
    
    public function contactIndex()

    { 
        // Returns the "contact" Blade view
        return view('contact' , ['pageName' => 'Contact']);
    }



    public function contactFormSubmit()
    {
        // Validate the form inputs
        $data= request()->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Email data
        // $data = [
        //     'firstname' => $request->firstname,
        //     'lastname' => $request->lastname,
        //     'email' => $request->email,
        //     'subject' => $request->subject,
        //     'messageContent' => $request->message,
        // ];

        // Send the email
      

       
Mail::to('abuguruth2022@gmail.com')->send(new ContactUs($data));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');

   
    
}
}
