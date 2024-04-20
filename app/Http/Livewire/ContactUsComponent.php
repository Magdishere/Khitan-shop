<?php

namespace App\Http\Livewire;

use App\Models\admin\Message;
use Livewire\Component;

class ContactUsComponent extends Component
{

    public $name;
    public $email;
    public $message;
    public $successMessage;

    public function submitForm()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        $this->successMessage = 'Your message has been sent successfully!';
        $this->reset(); // Reset form fields after submission
    }

    public function render()
    {
        return view('livewire.contact-us-component');
    }
}
