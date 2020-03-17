<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeagueRequest;
use App\League;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('league.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LeagueRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(LeagueRequest $request)
    {
        $league = League::create($request->all());
        return redirect(route('league.show', $league->id));
    }

    /**
     * Display the specified resource.
     *
     * @param League $league
     * @return Factory|View
     */
    public function show(League $league)
    {
        return view('league.show', ['league' => $league]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param League $league
     * @return Response
     */
    public function edit(League $league)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param League $league
     * @return Response
     */
    public function update(Request $request, League $league)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param League $league
     * @return Response
     */
    public function destroy(League $league)
    {
        //
    }
}
