<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Models\Location;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $locations = Location::with('children')->where('parent_id', null)->get(['id', 'name', 'enabled']);
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $locations = Location::all();
        return view('locations.create', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLocationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLocationRequest $request)
    {
        $data = $request->validated();

        /**
         * @var Location $location
         */
        $location = Location::create([
            'name' => $data['name'],
            'enabled' => true
        ]);
        if (array_key_exists('parent', $data) && !empty($data['parent'])) {
            $location->parent()->associate(Location::find($data['parent']));
        }

        if (array_key_exists('children', $data) && !empty($data['children'])) {
            $models = [];
            foreach ($data['children'] as $child) {
                if (is_numeric($child)) {
                    $models[] = Location::find($child);
                } else {
                    $models[] = Location::create([
                        'name' => $child,
                        'enabled' => true
                    ]);
                }

            }
            $location->children()->saveMany($models);
        }

        return response()->redirectToRoute('locations.index');
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
