<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use SendGrid;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $sendGridObj;

    public function __construct()
    {
        $apiKey = getenv('SENDGRID_API_KEY');
        $this->sendGridObj = new SendGrid($apiKey);
    }
}
