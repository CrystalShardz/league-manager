<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $members = Member::all();
        return view("members.index", compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view("members.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMemberRequest $request
     * @return RedirectResponse
     */
    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();

        $member = Member::create([
            'name' => $data['name']
        ]);

        return response()->redirectToRoute("members.index");
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
     * @param Member $member
     * @return RedirectResponse
     */
    public function destroy(Member $member)
    {
        try {
            $member->delete();
        } catch (\Exception $e) {
            //
        }

        return response()->redirectToRoute('members.index');
    }
}
