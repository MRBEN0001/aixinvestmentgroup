<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string'],
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
        ]);
        Contact::create($request->all());
        session()->flash('success', 'Message delivered succesfully');
        return redirect('/contact-us');
    }
}
