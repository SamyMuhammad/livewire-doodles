<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Mail\ContactUsMailable;
use App\Http\Livewire\ContactForm;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function contact_us_page_contains_the_livewire_component()
    {
        $this->get('/contact-us')
            ->assertSeeLivewire('contact-form');
    }

    /** @test */
    public function contact_form_sends_out_an_email()
    {
        Mail::fake();
        $data['name'] = 'Some User';
        $data['phone'] = '01425874655';
        $data['email'] = 'user@email.com';
        $data['message'] = 'This is some sort of message.';
        Livewire::test(ContactForm::class)
            ->set('name', $data['name'])
            ->set('phone', $data['phone'])
            ->set('email', $data['email'])
            ->set('message', $data['message'])
            ->call('submitForm')
            ->assertSee('We received your message successfully, and we will get back to you shortly.');
        
        Mail::assertSent(function (ContactUsMailable $mail) use ($data)
        {
            $mail->envelope();

            return $mail->hasTo('admin@livewire-app.com') &&
                $mail->hasFrom($data['email']) &&
                $mail->hasSubject('Contact Us Message');
        });
    }

    /** @test */
    public function contact_form_name_field_is_required()
    {
        $data['name'] = 'Some User';
        $data['phone'] = '01425874655';
        $data['email'] = 'user@email.com';
        $data['message'] = 'This is some sort of message.';
        Livewire::test(ContactForm::class)
            ->set('phone', $data['phone'])
            ->set('email', $data['email'])
            ->set('message', $data['message'])
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }
}
