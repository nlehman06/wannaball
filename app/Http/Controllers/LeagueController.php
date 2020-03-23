<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeagueRequest;
use App\League;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class LeagueController extends Controller {

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
        $league = auth()->user()->leagues()->create($request->all());

        $league->admins()->attach(auth()->id());
        $league->members()->attach(auth()->id());

        return redirect(route('league.show', $league->id));
    }

    /**
     * Display the specified resource.
     *
     * @param League $league
     * @return Factory|View
     * @throws AuthorizationException
     */
    public function show(League $league)
    {
        $this->authorize('view', $league);

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
     * @param LeagueRequest $request
     * @param League $league
     * @return RedirectResponse|Redirector
     */
    public function update(LeagueRequest $request, League $league)
    {
        $league->update($request->all());

        return redirect(route('league.show', $league));
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
