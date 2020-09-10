<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class Email extends Component
{
    public $email;

    public function sendResetLinkEmail()
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $response = $this->broker()->sendResetLink(['email' => $this->email]);

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->addError('email', trans($response));
    }

    public function broker()
    {
        return Password::broker();
    }

    protected function sendResetLinkResponse($response)
    {
        session()->flash('status', trans($response));

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.auth.passwords.email')->extends('layouts.auth');
    }
}
