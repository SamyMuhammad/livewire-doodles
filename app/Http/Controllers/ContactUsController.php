<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function showForm()
    {
        return view('contact-us');
    }

    public function sendEmailToAdmin(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'phone' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:3'],
        ]);
        Mail::to('admin@livewire-app.com')->send(new ContactUsMailable($data));
        session()->flash('success_message', 'We received your message successfully, and we will get back to you shortly.');
        return back();
    }
}
