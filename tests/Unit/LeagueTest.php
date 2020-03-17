<?php

namespace Tests\Unit;

use App\League;
use App\Meet;
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
}
