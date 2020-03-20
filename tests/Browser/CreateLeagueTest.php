<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateLeagueTest extends DuskTestCase {

    use DatabaseMigrations;
    public $user;

    protected function setUp(): void
    {
        parent::setUp();

        if (!$this->user)
        {
            $this->user = factory(User::class)->create();
        }
    }

    /** @test */
    public function create_form_should_include_a_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('league.create'))
                ->assertVisible('#name');
        });
    }

    /** @test */
    public function pressing_the_submit_button_stores_the_league()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('league.create'))
                ->type('#name', 'My New League')
                ->click('#submit')
                ->assertSee('My New League');
        });
    }

    /** @test */
    public function shows_an_error_if_name_is_not_long_enough()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                ->visit(route('league.create'))
                ->type('#name', 'My')
                ->click('#submit')
                ->assertVisible('#errorName');
        });
    }
}
