<?php

namespace App\Http\Livewire;

use App\Models\Contactus as ModelsContactus;
use Livewire\Component;


class Contactus extends Component
{

    public $name, $email, $message;

    public function render()
    {
        return view('livewire.contactus');
    }

    public function sendMessage() {
        $contact = new ModelsContactus();
        $contact->name = $this->name;
        $contact->email = $this->email;
        $contact->message = $this->message;
        $contact->remote_addr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
        $contact->user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $contact->save();

        session()->flash('message', 'Thanks for your message');
        return redirect()->to('/contact-us');
    }
}
