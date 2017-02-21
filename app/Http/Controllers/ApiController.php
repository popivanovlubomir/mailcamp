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
        $response = $this->formatResponse($response_obj);

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
        $response = $this->formatResponse($response_obj);

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
        $response = $this->formatResponse($response_obj);

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

        $response = $this->formatResponse($response_obj);

        $campaigns_list = $response['body']->result;

        return $campaigns_list;
    }


    /**
     *
     * Function to send test mail for particular campaign
     *
     * @param $campaign_id
     * @param $request_data
     * @return array
     */
    public function sendTestCampaign($campaign_id, $request_data)
    {
        $response_obj = $response = [];

        $response_obj = $this->request->client->campaigns()->_($campaign_id)->schedules()->test()->post($request_data);
        $response = $this->formatResponse($response_obj);

        return $response;
    }

    /**
     *
     *
     * Function to send campaign now
     *
     * @param $campaign_id
     * @param $request_data
     * @return array
     */
    public function sendCampaign($campaign_id, $request_data)
    {
        $response_obj = $response = [];

        $response_obj = $this->request->client->campaigns()->_($campaign_id)->schedules()->now()->post($request_data);
        $response = $this->formatResponse($response_obj);

        return $response;
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

        $response = $this->formatResponse($response_obj);

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

        $response = $this->formatResponse($response_obj);

        if (!isset($response['errors'])) {
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
        $response = $this->formatResponse($response_obj);

        if (!isset($response['errors'])) {
            $contacts_lists = $response['body']->recipients;
        }

        return $contacts_lists;
    }

    /**
     *
     * Function to retrieve contacts list data
     *
     * @param $query_params
     * @param $list_id
     * @return array
     */
    public function getContactsListData($list_id, $query_params)
    {

        $response_obj = $response = [];

        $response_obj = $this->request->client->contactdb()->lists()->_($list_id)->get(null, $query_params);

        $response = $this->formatResponse($response_obj);

        return $response;

    }
    /**
     *
     * Function to associate contacts to particular list
     *
     * @param $list_id
     * @param $request_data
     * @return array
     */
    public function associateContactsToList($list_id, $request_data)
    {
        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->contactdb()->lists()->_($list_id)->recipients()->post($request_data);

        $response = $this->formatResponse($response_obj);

        return $response;
    }

    /**
     *
     * Function for storing contacts in API
     *
     * @param $request_data
     * @return array
     */
    public function storeContacts($request_data)
    {
        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->contactdb()->recipients()->post($request_data);

        $response = $this->formatResponse($response_obj);

        return $response;
    }

    /**
     *
     * Function for searching contacts in API by given criterias
     *
     * @param $request_data
     * @return array
     */
    public function searchContacts($request_data)
    {

        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->contactdb()->recipients()->search()->get(null, $request_data);

        $response = $this->formatResponse($response_obj);

        return $response;

    }


    /**
     *
     * Function for storing sender identity
     *
     * @param $request_data
     * @return array
     */
    public function storeSender($request_data)
    {
        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->senders()->post($request_data);

        $response = $this->formatResponse($response_obj);

        return $response;
    }

    /**
     *
     * Function to fetch all stored senders
     *
     * @return array
     */
    public function getSendersData()
    {

        $response_obj = $response = [];

        $response_obj = $this->request->client->senders()->get();

        $response = $this->formatResponse($response_obj);

        return $response;
    }

    public function getSuppressionsGroupsData($request_data)
    {
        $response_obj = $response = [];

        $request_data = json_decode(json_encode($request_data));

        $response_obj = $this->request->client->asm()->groups()->get(null ,$request_data);

        $response = $this->formatResponse($response_obj);

        return $response;
    }

    public function sendEmail($request_data)
    {
//        $request_body = json_decode('{
//          "recipient_emails": [
//            "test1@example.com",
//            "test2@example.com"
//          ]
//        }');
//
//
//        $response_obj = $this->request->client->asm()->suppressions()->unsubscribes()->get();

//        $response_obj = $this->request->client->asm()->groups()->post($request_body);
//        $response_obj = $this->request->client->asm()->suppressions()->global()->post($request_body);
//        dump($response_obj->statusCode());
//        dump($response_obj->body());
//        dump($response_obj->headers());
//
//        $query_params = json_decode('{"id": 1}');
//        $response_obj = $this->request->client->asm()->groups()->get();
//        dump($response_obj->statusCode());
//        dump($response_obj->body());
//        dump($response_obj->headers());


//        $response = $this->formatResponse($response_obj);
//
//        die('END');

        $response_obj = $response = $contacts_data = [];

        //create batch id
        $response_obj = $this->request->client->mail()->batch()->post();

        $response = $this->formatResponse($response_obj);

        $batch_id = $response['body']->batch_id;

        $request_body = [
            'personalizations' => [
                [
                    "subject" => $request_data['subject'],
                    "headers" => [
                        "X-Accept-Language" => "en",
                        "X-Mailer" => "MyApp"
                    ],
                    'to' => $request_data['contacts'],
                    "send_at" => time()
                ],
            ],
            'from' => ['email' => $request_data['from'], 'name' => $request_data['from_name']],
            'batch_id' => $batch_id,
            'content' => [['type' => 'text/html', 'value' => '<html>'.$request_data['html_content'].'</p></html>']],
            'tracking_settings' => ['click_tracking' => ['enable' => true, 'enable_text' => true]],
//            'open_tracking' => ['enable' => true, 'substitution_tag' =>  "%opentrack"],
//            'subscription_tracking' => [ NOT ALLOWED
//                'enable' => true,
//                'substitution_tag' => "<%click here%>",
//                'html' =>  "<p> Test Unsubscribe here  </p> .",
//                'text' => "Unsubscribe here <%  %>."
//            ],
//            'asm' => [
//                'group_id' => 1959
//            ]
        ];

        $request_body = json_decode(json_encode($request_body));

        $response_obj = $this->request->client->mail()->send()->post($request_body);
        $response = $this->formatResponse($response_obj);

        if (!isset($response['errors'])) {

            $query_params = json_decode('{"aggregated_by": "day", "limit": 30, "start_date": "2016-01-01", "end_date": "2016-04-01", "offset": 1}');
            $query_params = json_decode('{"aggregated_by" : "day", "start_date" : "2016-02-16", "end_date": "2016-02-20"}');
            $response2 = $this->request->client->stats()->get(null, $query_params);

            $body = json_decode($response2->body());

            $query_params = json_decode('{"start_time": 1, "limit": 1, "end_time": 1, "offset": 1}');
            $response = $this->request->client->suppression()->unsubscribes()->get(null, $query_params);
//            dump($response->statusCode());
            dump($response_obj);
//            dump($response->headers());

            dd($body);
        } else {
            dd($response);
        }

    }

    public function sendSingleEmail($request_data)
    {

        $response_obj = $response = $contacts_data = [];

//        $response_obj = $this->request->client->mail()->batch()->post();

//        $response = $this->formatResponse($response_obj);

//        $batch_id = $response['body']->batch_id;

        $request_body = [
            'personalizations' => [
                [
                    "subject" => $request_data['subject'],
                    "headers" => [
                        "X-Accept-Language" => "en",
                        "X-Mailer" => "MyApp"
                    ],
                    'to' => $request_data['contacts'],
                    "send_at" => time()
                ],
            ],
            'from' => ['email' => $request_data['from'], 'name' => $request_data['from_name']],
//            'batch_id' => $batch_id,
            'content' => [['type' => 'text/html', 'value' => '<html>'.$request_data['html_content'].'</html>']],
            'tracking_settings' => ['click_tracking' => ['enable' => true, 'enable_text' => true]],
        ];

        $request_body = json_decode(json_encode($request_body));

        $response_obj = $this->request->client->mail()->send()->post($request_body);
        $response = $this->formatResponse($response_obj);

        if (!isset($response['errors'])) {
            return true;
        } else {
            dd($response_obj);
        }


    }

    /**
     *
     * Format the API response
     *
     * @param $response_obj
     * @return array
     */
    private function formatResponse($response_obj) {

        $response = [];
        $status = '';

        $status = $response_obj->statusCode();
        $response['body'] = json_decode($response_obj->body());
        $response['headers'] = $response_obj->headers();

//        switch ($status) {
//            case 200 :
//                $response['status'] = 'OK';
//                break;
//
//        }

        //if there are errors
        if(!empty($response['body']->errors)) {
            foreach ($response['body']->errors as $error) {
                $response['errors'][] = $error->message;
            }
        }

        return $response;
    }

}
