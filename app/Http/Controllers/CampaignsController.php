<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use SendGrid;


class CampaignsController extends Controller
{
    /**
     * Display a listing of the campaigns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $campaigns_response = $this->sendGridObj->client->campaigns()->get();

            $campaigns_list = json_decode($campaigns_response->body());

            $campaigns = $campaigns_list->result;

            return view('campaigns.index', compact('campaigns'));

        } catch (Exception $e) {

            return 'error';

        }

        dump($response->statusCode());
        dump($response->headers());
        dump($response->body());

        die();
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

        $response = $request_body = [];
        $data = $request->except('_token');
        $request_body = json_decode(json_encode($data));

        try {

            $response = $this->sendGridObj->client->campaigns()->post($request_body);

            switch ($response->statusCode()) {
                case 400 : {
                    $response = json_decode($response->body());
                    dd($response);
                }
            }

            return Redirect::to('/listcampaigns');

        } catch (Exception $e) {

            return 'error';

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
        $response = $campaign_data = $sheduled_data = [];

        //get the campaign basic data
        $response = $this->sendGridObj->client->campaigns()->_($id)->get();

        $campaign_data = json_decode($response->body());

        //get the campaign shedule
        $response = $this->sendGridObj->client->campaigns()->_($id)->schedules()->get();

        $sheduled_data = json_decode($response->body());

        dump($sheduled_data);
        dump($campaign_data);

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
