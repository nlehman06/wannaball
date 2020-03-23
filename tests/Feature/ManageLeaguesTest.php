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

    // Create and Store

    /**
     * @test
     * @group createLeague
     */
    public function a_user_may_create_a_league()
    {
        $leagueData = factory(League::class)->make();

        $this->followingRedirects()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertViewIs('league.show')
            ->assertSee($leagueData->name);

        $this->assertDatabaseHas('leagues', [
            'name' => $leagueData->name,
            'creator_id' => $this->user->id
        ]);
    }

    /**
     * @test
     * @group createLeague
     */
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

    /**
     * @test
     * @group createLeague
     */
    public function guests_may_not_create_leagues()
    {
        $leagueData = factory(League::class)->make();

        auth()->logout();
        $this->withExceptionHandling()
            ->post(route('league.store'), $leagueData->toArray())
            ->assertRedirect('login');
    }

    /**
     * @test
     * @group createLeague
     */
    public function going_to_the_create_league_route_loads_the_create_view()
    {
        $this->get(route('league.create'))
            ->assertViewIs('league.create');
    }

    // Edit and Update

    /**
     * @test
     * @group editLeague
     */
    public function a_user_may_edit_a_league()
    {
        $league = $this->createLeague();
        $league->name = 'Changed League';

        $this->followingRedirects()
            ->patch(route('league.update', $league), $league->toArray())
            ->assertOk()
            ->assertViewIs('league.show')
            ->assertSee('Changed League');
    }

    /**
     * @test
     * @group editLeague
     */
    public function editing_league_has_validation_rules()
    {
        $league = $this->createLeague();
        $league->name = 'Ch';

        $this->withExceptionHandling()
            ->patch(route('league.update', $league), $league->toArray())
            ->assertSessionHasErrors('name');
    }

    /**
     * @test
     * @group editLeague
     */
    public function guest_may_not_edit_a_league()
    {
        $league = factory(League::class)->create();

        auth()->logout();

        $this->withExceptionHandling()
            ->patch(route('league.update', $league), [])
            ->assertRedirect('login');
    }

    /**
     * @test
     * @group editLeague
     */
    public function non_league_admin_may_not_edit_a_league()
    {
        $league = factory(League::class)->create();

        $this->withExceptionHandling()
            ->actingAs(factory(User::class)->create())
            ->patch(route('league.update', $league), $league->toArray())
            ->assertForbidden();
    }

    // View

    /**
     * @test
     * @group viewLeague
     */
    public function an_admin_can_view_the_league()
    {
        $league = $this->createLeague();

        $this->get(route('league.show', $league))
            ->assertOk()
            ->assertSee($league->name);
    }

    /**
     * @test
     * @group viewLeague
     */
    public function a_random_user_may_not_view_a_league()
    {
        $league = $this->createLeague();

        $this->withExceptionHandling()
            ->actingAs(factory(User::class)->create())
            ->get(route('league.show', $league))
            ->assertForbidden();

    }

    /**
     * @test
     * @group viewLeague
     */
    public function a_league_member_may_view_the_league()
    {
        $league = $this->createLeague();

        $member = factory(User::class)->create();
        $this->post(route('member.store', [$league, $member]));

        $this->actingAs($member)
            ->get(route('league.show', $league))
            ->assertOk();
    }

    /**
     * @return mixed
     */
    private function createLeague()
    {
        $leagueData = factory(League::class)->make();
        $this->post(route('league.store'), $leagueData->toArray());
        return League::whereName($leagueData->name)->first();
    }
}
