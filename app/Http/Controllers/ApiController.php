<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use SendGrid;
class ApiController extends Controller
{
    private $request;

    public function __construct()
    {
        $apiKey = getenv('SENDGRID_API_KEY');
        $this->request = new SendGrid($apiKey);
    }

    /**
     *
     * Function to get the sheduled time of given campaign
     *
     * @param $campaign_id
     * @return array
     */
    public function getSheduledTimeCampaign($campaign_id)
    {

        $response_obj = $response = $time_data = [];

        $response_obj = $this->request->client->campaigns()->_($campaign_id)->schedules()->get();
        $response = $this->makeResponse($response_obj);

        $time_data = $response['body'];

        return $time_data;
    }

    /**
     *
     * Function to get single campaign data
     *
     * @param $campaign_id
     * @return array
     */
    public function getSingleCampaign($campaign_id)
    {

        $response_obj = $response = $campaign_data = [];

        $response_obj = $this->request->client->campaigns()->_($campaign_id)->get();
        $response = $this->makeResponse($response_obj);

        $campaign_data = $response['body'];

        return $campaign_data;
    }

    /**
     *
     * Function to create campaign
     *
     * @param $request_data
     * @return array
     */
    public function storeCampaign($request_data)
    {

        $response_obj = $response = [];

        $response_obj = $this->request->client->campaigns()->post($request_data);
        $response = $this->makeResponse($response_obj);

        return $response;

    }

    /**
     *
     * Function to fetch all campaigns
     *
     * @return array
     */
    public function getAllCampaigns()
    {

        $response_obj = $response = $campaigns_list = [];

        $response_obj = $this->request->client->campaigns()->get();

        $response = $this->makeResponse($response_obj);

        $campaigns_list = $response['body']->result;

        return $campaigns_list;
    }

    /**
     *
     * Function to create contacts list
     *
     * @param $request_data
     * @return array
     */
    public function storeContactsList($request_data)
    {

        $response_obj = $response = [];

        $response_obj = $this->request->client->contactdb()->lists()->post($request_data);

        $response = $this->makeResponse($response_obj);

        return $response;

    }

    /**
     *
     * Function to fetch all contacts lists
     *
     * @return array
     */
    public function getContactsLists()
    {

        $response_obj = $response = $contacts_lists = [];

        $response_obj = $this->request->client->contactdb()->lists()->get();

        $response = $this->makeResponse($response_obj);

        if(!isset($response['errors'])) {
            $contacts_lists = $response['body']->lists;
        }

        return $contacts_lists;
    }

    /**
     *
     * Function to fetch all contacts for a list
     *
     * @param $list_id
     * @return array
     */
    public function getContactsForList($list_id)
    {
        $response_obj = $response = $contacts_lists = [];

        $response_obj = $this->request->client->contactdb()->lists()->_($list_id)->recipients()->get();
        $response = $this->makeResponse($response_obj);

        if(!isset($response['errors'])) {
            $contacts_lists = $response['body']->recipients;
        }

        return $contacts_lists;
    }

    public function associateContactsToList($list_id, $request_data)
    {
        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->contactdb()->lists()->_($list_id)->recipients()->post($request_data);

        $response = $this->makeResponse($response_obj);

        return $response;
    }

    public function storeContacts($request_data) {
        $response_obj = $response = $contacts_data = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->contactdb()->recipients()->post($request_data);

        $response = $this->makeResponse($response_obj);

        if(!isset($response['errors'])) {
            $contacts_data = $response['body']->persisted_recipients;
        }

        return $contacts_data;
    }


    /**
     *
     * Make the API response
     *
     * @param $response_obj
     * @return array
     */
    private function makeResponse($response_obj) {

        $response = [];
        $status = '';

        $status = $response_obj->statusCode();
        $response['body'] = json_decode($response_obj->body());
        $response['headers'] = $response_obj->headers();

        switch ($status) {
            case 200 :
                $response['status'] = 'OK';
                break;

        }

        //if there are errors
        if(!empty($response['body']->errors)) {
            foreach ($response['body']->errors as $error) {
                $response['errors'][] = $error->message;
            }
        }

        return $response;
    }

}
