<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Exception;
use SendGrid;


class CampaignsController extends ApiController
{
    /**
     * Display a listing of the campaigns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = $this->getAllCampaigns();

        return view('campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $response = $this->storeCampaign($data);
        if(isset($response['errors'])) {
            return Redirect::to('/campaigns/create')->withErrors($response['errors'])->withInput();
        } else {
            return Redirect::to('/campaigns');
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
        $campaign_data = $this->getSingleCampaign($id);
        $sheduled_data = $this->getSheduledTimeCampaign($id);

        return view('campaigns.view', compact('campaign_data', 'sheduled_data'));
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
