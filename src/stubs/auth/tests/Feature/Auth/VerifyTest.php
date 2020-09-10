<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use Tests\TestCase;

class VerifyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_view_verification_page()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        Auth::login($user);

        $this->get(route('verification.notice'))
            ->assertSuccessful()
            ->assertSeeLivewire('auth.verify');
    }

    /** @test */
    public function can_resend_verification_email()
    {
        $user = User::factory()->create();

        Livewire::actingAs($user);

        Livewire::test('auth.verify')
            ->call('resend')
            ->assertSessionHas('resent', true);
    }

    /** @test */
    public function can_verify()
    {
        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        Auth::login($user);

        $url = URL::temporarySignedRoute('verification.verify', Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)), [
            'id' => $user->getKey(),
            'hash' => sha1($user->getEmailForVerification()),
        ]);

        $this->get($url)
            ->assertRedirect(RouteServiceProvider::HOME);

        $this->assertTrue($user->hasVerifiedEmail());
    }
}
