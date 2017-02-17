<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SendGrid;

class TestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $from = new SendGrid\Email('Lubomir Popivanov', 'popivanov.lubomir@gmail.com');
        $subject = 'Test subject';
        $to = new SendGrid\Email(null, 'lpopivanov@sbnd.net');
        $content = new SendGrid\Content('text/html', "<html><body>some text here</body></html>");

        $mail = new SendGrid\Mail($from, $subject, $to, $content);


        $sendGrid = new SendGrid(getenv('SENDGRID_API_KEY'));

        $response = $sendGrid->client->mail()->send()->post($mail);

        dd($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
