<?php

namespace Tests\Feature;

use App\League;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageLeaguesTest extends TestCase
{

    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        $this->user = factory(User::class)->create();

        $this->actingAs($this->user);
    }

    /** @test */
    public function a_user_may_create_a_league()
    {
        $leagueData = factory(League::class)->make();

        $this->followingRedirects()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertViewIs('league.show')
            ->assertSee($leagueData->name);

        $this->assertDatabaseHas('leagues', ['name' => $leagueData->name]);
    }

    /** @test */
    public function a_league_requires_a_name()
    {
        $leagueData = factory(League::class)->make(['name' => '']);

        $this->withExceptionHandling()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertSessionHasErrors('name');

        $leagueData->name = 'aa';
        $this->withExceptionHandling()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function guests_may_not_create_leagues()
    {
        $leagueData = factory(League::class)->make();

        auth()->logout();
        $this->withExceptionHandling()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertRedirect('login');
    }
}
