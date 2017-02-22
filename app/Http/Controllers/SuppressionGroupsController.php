<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SuppressionGroupsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppression_groups = [];

        $suppression_groups = $this->getSuppressionGroupsData([]);

        if(!isset($suppression_groups['errors'])) {
            $suppression_groups = $suppression_groups['body'];
        }

        return view('suppressiongroups.index', compact('suppression_groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppressiongroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ////
        $response = $data = [];

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        $data = $request->except("_token");

        $response = $this->storeSuppressionGroup($data);

        if(isset($response['errors'])) {
            return back()->withErrors($response['errors'])->withInput();
        } else {
            return Redirect::to('/suppressiongroups')->with('status', 'Suppression group was successfully created!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
