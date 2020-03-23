<?php

namespace Tests\Unit;

use App\League;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_the_creator_of_multiple_leagues()
    {
        $league1 = factory(League::class)->make();
        $league2 = factory(League::class)->make();

        $this->actingAs($user = factory(User::class)->create());

        $user->leagues()->saveMany([$league1, $league2]);

        $this->assertCount(2, $user->leagues);
    }
}
