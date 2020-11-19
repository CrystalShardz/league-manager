<?php

namespace App\Http\Controllers;

use App\Generators\RoundRobin;
use App\Models\Season;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FixturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Season $season
     * @return Application|Factory|View
     */
    public function index(Season $season)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Season $season
     * @return Application|Factory|View|Response
     */
    public function create(Season $season)
    {
        //
    }

    /**
     * @param Season $season
     * @return Application|Factory|View
     */
    public function generate(Season $season)
    {
        return view('fixtures.generate', compact('season'));
    }

    public function doGenerate(Season $season, Request $request)
    {
        $data = $this->validate($request, [
            'roundsToGenerate' => 'required|numeric|min:1'
        ]);

        $generator = new RoundRobin($season, $data['roundsToGenerate'], true);

        $rounds = $generator->generate();

        return response()->redirectToRoute('seasons.show', [$season]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
