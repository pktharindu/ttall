<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public function signup()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        event(new Registered($user = $this->create()));

        $this->guard()->login($user);

        redirect(RouteServiceProvider::HOME);
    }

    protected function create()
    {
        return User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
