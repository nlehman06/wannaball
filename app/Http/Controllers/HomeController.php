<?php

namespace App\Http\Controllers;

use App\League;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $topLeagues = League::recentlyMet()->limit(5)->get();
        return view('home', compact('topLeagues'));
    }
}
