<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SendersController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $senders = $this->getSendersData();

        if(!isset($senders['errors'])) {
            $senders = $senders['body'];
        }

        return view('senders.index', compact('senders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('senders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $response = $submitted_data = $request_data = [];

        $this->validate($request, [
            'nickname' => 'required',
            'from_email' => 'required',
            'reply_email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required'
        ]);

        $submitted_data = $request->except("_token");

        $request_data = [
            'nickname' => $submitted_data['nickname'],
            'from' => [
                'email' => $submitted_data['from_email'],
                'name' => $submitted_data['from_name']
            ],
            'reply_to' => [
                'email' => $submitted_data['reply_email'],
                'name' => $submitted_data['reply_name']
            ],
            'address' => $submitted_data['address'],
            'address_2' => $submitted_data['address_2'],
            'city' => $submitted_data['city'],
            'state' => $submitted_data['state'],
            'country' => $submitted_data['country'],
            'zip' => $submitted_data['zip'],
        ];

        $response = $this->storeSender($request_data);

        if(isset($response['errors'])) {
            return back()->withErrors($response['errors'])->withInput();
        } else {
            return Redirect::to('/senders')->with('status', 'Sender was successfully created! A verification email is sent!');
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
        $sender_data_response = $sender_data = [];

        $sender_data_response = $this->getSenderIdentity($id);

        if(isset($sender_data['errors'])) {
            return back()->withErrors($sender_data['errors']);
        }

        $sender_data = $sender_data_response['body'];

        return view('senders.view', compact('sender_data'));

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
