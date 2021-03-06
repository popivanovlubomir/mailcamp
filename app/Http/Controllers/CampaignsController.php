<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
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
        $contacts_list = $senders_data = $suppression_groups = [];

        $contacts_list = $this->getContactsLists();

        $senders_data = $this->getSendersData();

        if(!isset($senders_data['errors'])) {
            $senders_data = $senders_data['body'];
        }

        $suppression_groups = $this->getSuppressionGroupsData([]);

        if(!isset($suppression_groups['errors'])) {
            $suppression_groups = $suppression_groups['body'];
        }

        return view('campaigns.create', compact('contacts_list', 'senders_data', 'suppression_groups'));
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

        $this->validate($request, [
            'title' => 'required',
            'subject' => 'required',
            'categories' => 'required',
            'html_content' => 'required|has_unsubscribe_tag',
            'plain_content' => 'required|has_unsubscribe_tag',
            'list_ids' => 'required',
            'sender_id' => 'required',
            'suppression_group_id' => 'required',
        ]);

        //set the categories of the campaign
        $data['categories'] = array_map("trim", explode(",", $request->get('categories')));

        $response = $this->storeCampaign($data);

        if(isset($response['errors'])) {

            return back()->withInput()->withErrors($response['errors']);

        } else {

            return Redirect::to('/campaigns')->with('status', 'Campaign was successfully created!');
        }

    }

    /**
     *
     * Function to test campaign
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function testCampaign(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'campaign_id' => 'required|int'
        ]);

        //send test campaign message
        $response_test_campaign = $this->sendTestCampaign($request->get('campaign_id'), ['to' => $request->get('email')]);

        if(isset($response_test_campaign['errors'])) {
            return back()->withInput()->withErrors($response_test_campaign['errors']);
        }

        return  back()->with('status', 'Test email was successfully sent!');
    }

    /**
     *
     * Send Campaign
     *
     * @param Request $request
     * @return $this
     */
    public function sendCampaign(Request $request)
    {

        $this->validate($request, [
            'campaign_id' => 'required|int'
        ]);

        $response = $this->sendImmediatelyCampaign($request->get('campaign_id'));

        if(isset($response['errors'])) {
            return back()->withInput()->withErrors($response['errors']);
        }

        return Redirect::to('/campaigns')->with('status', 'Campaign was successfully sent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign_data = $sheduled_data = $response_list_data = $lists_data = [];

        $campaign_data = $this->getSingleCampaign($id);
        $sheduled_data = $this->getSheduledTimeCampaign($id);

        if(!empty($campaign_data->list_ids)) {
            foreach ($campaign_data->list_ids as $list_id) {
                $response_list_data = $this->getContactsListData($list_id, ['list_id' => $list_id]);
                if(!isset($response_list_data['errors'])) {
                    $lists_data[] =  [
                        'id' => $response_list_data['body']->id,
                        'name' => $response_list_data['body']->name,
                        'recipient_count' => $response_list_data['body']->recipient_count,
                    ];
                }
            }
        }

        return view('campaigns.view', compact('campaign_data', 'sheduled_data', 'lists_data'));
    }

    public function sendMassMailPage()
    {
        return view('campaigns.sendemail');
    }

    public function sendAutomaticallMassMail(Request $request)
    {

        $this->validate($request, [
            'subject' => 'required',
            'name' => 'plain_content',
            'html_content' => 'required|has_unsubscribe_tag',
            'plain_content' => 'required|has_unsubscribe_tag',
            'contacts_lits' => 'required',
        ]);

        if ($request->hasFile('contacts_lits')) {

            $recipients_list = $list = $formatted_list = $response = [];
            $filePath = '';

            //get the filepath
            $filePath = $request->contacts_lits->getRealPath();

            //get the data
            $list = array_map('str_getcsv', file($filePath));

            //remove the headers
            array_shift($list);

            //create list
            $contacts_list_request = ['name' => 'Campaign'.time()];
            $new_contacts_lists_data = $this->storeContactsList($contacts_list_request);

            //if there are errors redirect to the page
            if(isset($new_contacts_lists_data['errors'])) {
                return back()->withInput(Input::all())->withErrors($new_contacts_lists_data['errors']);
            }

            //add contacts as recipients in the API
            $iterator = new \ArrayIterator($list);

            // loop through the object and generate formatted list
            foreach ($iterator as $key => $value) {
                if($key > 600) break;
                $recipients_list[] = [
                    'email' => $value[0],
                    'first_name' => $value[1],
                    'last_name' => $value[2],
                ];
            }

            //store the contacts
            $recipients_response = $this->storeContacts($recipients_list);

            //if there are errors with storing contacts redirect to the page
            if(isset($recipients_response['errors'])) {
                return back()->withInput(Input::all())->withErrors($recipients_response['errors']);
            }

            //add contacts to the list
            $response = $this->associateContactsToList($new_contacts_lists_data['body']->id, $recipients_response['body']->persisted_recipients);

            //if association was successful
            //create the campaign
            $request_body = [
//                            'title' => $request->get('title'),
                'title' => $new_contacts_lists_data['body']->name,
                'subject' => $request->get('subject'),
                'plain_content' => $request->get('plain_content'),
                'html_content' => $request->get('html_content'),
                'list_ids' => [$new_contacts_lists_data['body']->id],
                'sender_id' => 109166, // @todo make automatically
                'suppression_group_id' => 1975 // @todo make automatically
            ];

            //make the request
            $response = $this->storeCampaign($request_body);

            //send test campaign message
            $response_test_campaign = $this->sendTestCampaign($response['body']->id, ['to' => 'lpopivanov@sbnd.net']);

            if(isset($response_test_campaign['errors'])) {
                return back()->withInput(Input::all())->withErrors($response['errors']);
            } else {

                $response = $this->sendCampaign($response['body']->id, $request_body);

                return Redirect::to('/campaigns')->with('status', 'Campaign was successfully created!');
            }


        }



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
