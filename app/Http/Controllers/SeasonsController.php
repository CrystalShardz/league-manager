<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeasonRequest;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeasonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $seasons = Season::all();
        return view('seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSeasonRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSeasonRequest $request)
    {
        $data = $request->validated();

        /**
         * @var Season $season
         */
        $season = Season::create([
            'name' => $data['name'],
            'datetime_start' => Carbon::createFromFormat("d/m/Y H:i", $data['datetime_start']),
        ]);

        $season->teams()->sync($data['teams']);

        return response()->redirectToRoute("seasons.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Season $season
     * @return Application|Factory|View|Response
     */
    public function show(Season $season)
    {
        return view('seasons.show', compact('season'));
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
     * @param Request $request
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
