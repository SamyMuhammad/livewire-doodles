<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\ContactUsMailable;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{
    public ?string $name = null;
    public ?string $phone = null;
    public ?string $email = null;
    public ?string $message = null;
    public ?string $successMessage = null;
    protected array $rules = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'phone' => ['required', 'string', 'min:3', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'message' => ['required', 'string', 'min:3'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $data = $this->validate();
        Mail::to('admin@livewire-app.com')->send(new ContactUsMailable($data));
        $this->reset(['name', 'phone', 'email', 'message']);
        $this->successMessage = 'We received your message successfully, and we will get back to you shortly.';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
