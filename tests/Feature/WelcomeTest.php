<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_will_see_the_login_link()
    {
        auth()->logout();

        $this->get('/')
            ->assertViewIs('welcome')
            ->assertSee('Log in')
            ->assertSee(route('login'))
            ->assertDontSee('Dashboard')
            ->assertDontSee(route('home'));
    }

    /** @test */
    public function signed_in_user_sees_dashboard()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertDontSee('Log in')
            ->assertDontSee(route('login'))
            ->assertSee('Dashboard')
            ->assertSee(route('home'));
    }
}
