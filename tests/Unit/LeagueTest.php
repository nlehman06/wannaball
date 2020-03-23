<?php

namespace Tests\Unit;

use App\League;
use App\Meet;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeagueTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_have_meets()
    {
        $league = factory(League::class)->create();

        $meet = factory(Meet::class)->create(['league_id' => $league->id]);

        $this->assertTrue($league->meets->contains($meet));
    }

    /** @test */
    public function it_can_be_sorted_by_most_recent_meet()
    {
        $second = factory(League::class)->create();
        $first = factory(League::class)->create();

        $second->meets()->save(factory(Meet::class)->make([
            'league_id' => $second->id,
            'meet_date' => today()->subDay()
        ]));
        $first->meets()->save(factory(Meet::class)->make([
            'league_id' => $second->id,
            'meet_date' => today()->subDays(2)
        ]));
        $first->meets()->save(factory(Meet::class)->make([
            'league_id' => $second->id,
            'meet_date' => today()
        ]));

        $leagues = League::recentlyMet()->get();

        $this->assertEquals($first->name, $leagues->first()->name);
        $this->assertCount(2, $leagues);
    }

    /** @test */
    public function it_can_have_many_admins()
    {
        $league = factory(League::class)->create();
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $league->admins()->saveMany([$user1, $user2]);

        $this->assertCount(2, $league->admins);
    }

    /** @test */
    public function the_creator_is_automatically_added_to_the_admins()
    {
        $this->actingAs($user = factory(User::class)->create());
        $league = factory(League::class)->make();
        $this->post(route('league.store'), $league->toArray());

        $leagueWithAdmin = League::whereHas('admins', function(Builder $query) use ($user) {
            return $query->where('user_id', $user->id);
        })->get();

        $this->assertCount(1, $leagueWithAdmin);
    }
}
