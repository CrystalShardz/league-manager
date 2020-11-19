<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Models\Member;
use App\Models\Team;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeamRequest $request
     * @return RedirectResponse
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $request->validated();


        $team = Team::create([
            'name' => $data['name'],
            'captain_id' => $data['captain_id'] ?? null
        ]);

        if (array_key_exists('members', $data) && count($data['members']) > 0) {
            $members = array();
            foreach ($data['members'] as $member) {
                if (is_numeric($member)) {
                    $members[] = Member::find($member);
                } else {
                    // create new member
                    $members[] = Member::create([
                        'name' => $member
                    ]);
                }
            }

            $team->members()->saveMany($members);
        }

        return response()->redirectToRoute('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Team $team
     * @return void
     */
    public function show(Team $team)
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
     *
     * Show the import page
     * @return Application|Factory|View
     */
    public function import()
    {
        return view('teams.import');
    }

    /**
     * Process the uploaded import file
     *
     * @param Request $request
     * @return mixed
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'uploadFile' => 'required|file|mimes:csv,txt'
        ]);

        $importFile = $request->file('uploadFile');

        $res = $importFile->openFile('r');
        $res->setFlags(\SplFileObject::READ_CSV);
        $headersSkipped = false;
        foreach($res as $line) {
            if(!$headersSkipped) {
                $headersSkipped = true;
                continue;
            }

            //sanitize data - remove anything that isn't a letter or a number
            $line[0] = preg_replace('/[^a-z0-9 ]+$/i', '', $line[0]);
            $line[1] = preg_replace('/[^a-z0-9 ]+$/i', '', $line[1]);

            /**
             * @var Member $member
             */
            $member = Member::create([
                'name' => $line[0]
            ]);

            /**
             * @var Team $team
             */
            $team = Team::firstOrCreate(['name' => $line[1]]);
            $team->members()->save($member);
        }

        return response()->redirectToRoute('teams.index');
    }

    /**
     * Offers the import template up for download
     *
     * @return BinaryFileResponse
     */
    public function importTemplate()
    {
        return response()->download(storage_path('app/public/import.csv'), 'import.csv', ['ContentType: text/csv']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return RedirectResponse
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
        } catch (\Exception $e) {
            //
        }

        return response()->redirectToRoute('teams.index');
    }
}
