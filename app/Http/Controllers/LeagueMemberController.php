<?php

namespace App\Http\Controllers;

use App\League;
use App\User;
use Illuminate\Http\Request;

class LeagueMemberController extends Controller {

    public function store(League $league, User $member)
    {
        $league->members()->attach($member->id);
    }
}
