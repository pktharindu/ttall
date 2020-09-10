<?php

namespace App\Http\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Livewire\Component;

class Login extends Component
{
    use AuthenticatesUsers;

    public $email;

    public $password;

    public $remember = false;

    public function authenticate()
    {
        return $this->login(new Request(collect($this)->toArray()));
    }

    protected function sendLoginResponse(Request $request)
    {
        session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
