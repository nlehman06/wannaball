<?php

namespace Tests\Feature;

use App\League;
use App\Meet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling();

        if(!$this->user) {
            $this->user = factory(User::class)->create();

            $this->actingAs($this->user);
        }
    }

    /** @test */
    public function shows_the_top_five_leagues_by_most_recent_meets()
    {
        $oldLeague = factory(League::class)->create();
        $oldLeague->meets()->save(factory(Meet::class)->make(['meet_date' => today()->subMonth()]));

        $recentLeagues = factory(League::class, 5)
            ->create()
            ->each(function($league) {
                $league->meets()->save(factory(Meet::class)->make(['meet_date' => today()]));
            });

        $this->get(route("home"))
            ->assertViewIs("home")
            ->assertViewHas('topLeagues')
            ->assertSee($recentLeagues->first()->name)
            ->assertDontSee($oldLeague->name);
    }

    /** @test */
    public function shows_create_league_link_if_not_apart_of_any_leagues()
    {
        $this->get(route("home"))
            ->assertSee("You aren't apart of any leagues yet.  Would you like to <a href=\"http://wannaball.test/league/create\">create one</a>?", false);
    }
}
