<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DealController extends Controller
{
    public function create()
    {
        //dd($this->refreshToken());
        // test for api
        $url = 'https://www.zohoapis.com/crm/v2/Deals';
        $token = '1000.ab03d356975efa9fa1eb8b8a6013a814.2449f9ca7e694bfa0ba6e9b60098946d';
        //$response = Http::withToken($token)->get($url);
        //dd($response->object()->status); // 'error'
        //dd($response->object()->data[0]->id); // 'error'
        // ---- create deal
        $array_param[] = [
            'Owner' => ["id" => "5149635000000345001"],
            "Account_Name" => ["id" => "5149635000000354785"],
            "Contact_Name" => ["id" => "5149635000000354878"],
            "Campaign_Source" => ["id" => "5149635000000382002"],
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

    public function refreshToken()
    {
        $url = 'https://accounts.zoho.com/oauth/v2/token';

        $response = Http::asForm()->post($url, [
            'client_id' => '1000.JW2BLTG0XC0NCYKZ8EXIJHGH4FYFCO',
            'client_secret' => '865d86fd87971686378cee5d5730058b1f1a607414',
            'refresh_token' => '1000.ea8830eef03958a61701d0113f46ed75.96627cc55d6457f66aa915c09022558d',
            'grant_type' => 'refresh_token',
        ]);
        return $response->object()->access_token;

    }
}
