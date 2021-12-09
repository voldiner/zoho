<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Session\Session;

class DealController extends BaseController
{
    public function index()
    {
        $this->create();
        return redirect('/');
    }

    public function create()
    {
        $url = 'https://www.zohoapis.com/crm/v2/Deals';
        $token = $this->getToken();
        $array_param[] = [
            'Owner' => ["id" => $this->getUser()->id],
            "Account_Name" => ["id" => $this->getRecord('Accounts')->id],
            "Contact_Name" => ["id" => $this->getRecord('Contacts')->id],
            "Campaign_Source" => ["id" => $this->getRecord('Campaigns')->id],
            "Type" => "New Business",
            "Description" => "Design your own layouts that align your business processes precisely. Assign them to profiles appropriately.",
            "Deal_Name" => "Deal_Name_Voldiner",
            "Amount" => 1000.67,
            "Next_Step" => "Next_Step",
            "Stage" => "Needs Analysis",
            "Lead_Source" => "Cold Call",
            "Closing_Date" => "2022-01-25"
        ];

        $parameters['data'] = $array_param;

        $response = Http::withToken($token)
            ->acceptJson()
           ->post($url, $parameters);
        dd($response->object());

    }
}
