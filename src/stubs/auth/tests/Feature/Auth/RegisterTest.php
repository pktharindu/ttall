<?php

namespace Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function registration_page_contains_livewire_component()
    {
        $this->get(route('register'))
            ->assertSuccessful()
            ->assertSeeLivewire('auth.register');
    }

    /** @test */
    public function is_redirected_if_already_logged_in()
    {
        $user = factory(User::class)->create();

        $this->be($user);

        $this->get(route('register'))
            ->assertRedirect(RouteServiceProvider::HOME);
    }

    /** @test */
    public function a_user_can_register()
    {
        Livewire::test('auth.register')
            ->set('name', 'Tall Stack')
            ->set('email', 'tallstack@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('signup')
            ->assertRedirect(RouteServiceProvider::HOME);

        $this->assertTrue(User::whereEmail('tallstack@example.com')->exists());
        $this->assertEquals('tallstack@example.com', Auth::user()->email);
    }

    /** @test */
    public function name_is_required()
    {
        Livewire::test('auth.register')
            ->set('name', '')
            ->call('signup')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function email_is_required()
    {
        Livewire::test('auth.register')
            ->set('email', '')
            ->call('signup')
            ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    public function email_is_valid_email()
    {
        Livewire::test('auth.register')
            ->set('email', 'tallstack')
            ->call('signup')
            ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    public function email_hasnt_been_taken_already()
    {
        factory(User::class)->create(['email' => 'tallstack@example.com']);

        Livewire::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->call('signup')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    public function see_email_hasnt_already_been_taken_validation_message_as_user_types()
    {
        factory(User::class)->create(['email' => 'tallstack@example.com']);

        Livewire::test('auth.register')
            ->set('email', 'smallstack@gmail.com')
            ->assertHasNoErrors()
            ->set('email', 'tallstack@example.com')
            ->call('signup')
            ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    public function password_is_required()
    {
        Livewire::test('auth.register')
            ->set('password', '')
            ->set('password_confirmation', 'password')
            ->call('signup')
            ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    public function password_is_minimum_of_eight_characters()
    {
        Livewire::test('auth.register')
            ->set('password', 'secret')
            ->set('password_confirmation', 'secret')
            ->call('signup')
            ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    public function password_matches_password_confirmation()
    {
        Livewire::test('auth.register')
            ->set('email', 'tallstack@example.com')
            ->set('password', 'password')
            ->set('password_confirmation', 'not-password')
            ->call('signup')
            ->assertHasErrors(['password' => 'confirmed']);
    }
}
