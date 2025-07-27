<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;

class ContactForm extends Component
{
    public $full_name, $email, $subject, $message;

    protected $rules = [
         'full_name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
    ];

    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'full_name' => $this->full_name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        session()->flash('success', 'تم إرسال رسالتك بنجاح!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
