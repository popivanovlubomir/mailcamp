<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactsController extends ApiController
{
    public function __construct(Request $request_obj)
    {
        parent::__construct();

        //share the list_id with all views
        view()->share('list_id', $request_obj->list_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($list_id)
    {
        $response = $this->getContactsForList($list_id);

        if(isset($response['errors'])) {
            return Redirect::to('/contactslist')->withErrors($response['errors'])->withInput();
        } else {
            return view('contacts.index', compact('contacts'))->with('contacts', $response);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $response = $list_response = [];

        $request_data[] = $request->except('_token', 'list_id');
        $list_id = $request->get('list_id');

        //store the contact as persistant
        $response = $this->storeContacts($request_data);

        if(isset($response['errors'])) {
            return back()->withErrors($response['errors'])->withInput();
        } else {
            // no errors so do the association to list
            // if list id is submitted
            if($list_id && !empty($response)) {
                //do the associations
                $this->associateContactsToList($list_id, $response);

                return redirect()->route('viewcontacts', ['list_id' => $list_id]);
            } else {
                return back();
            }

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
