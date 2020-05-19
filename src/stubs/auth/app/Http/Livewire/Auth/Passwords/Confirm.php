<?php

namespace App\Http\Livewire\Auth\Passwords;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Livewire\Component;

class Confirm extends Component
{
    use RedirectsUsers;

    public $password;

    public function confirm()
    {
        $this->validate([
            'password' => 'required|password',
        ]);

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended($this->redirectPath());
    }

    public function render()
    {
        return view('livewire.auth.passwords.confirm');
    }
}
