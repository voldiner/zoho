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
        $result = $this->create();
        if (isset($result['error'])){
            return redirect()->route('home')->with(['error' => 'Create Deal error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Create Deal success']);
    }

    public function create()
    {
        $result = [];
        if (!session()->has(['users', 'accounts','contacts', 'campaigns'])){
            $result['error'] = 'Помилка! Спочатку необхідно виконати GetUser, GetAccount, Get Contact, Get Campain';
            return $result;
        }
        $url = 'https://www.zohoapis.com/crm/v2/Deals';
        $token = $this->getToken();
        if ($token) {
            $array_param[] = [
                'Owner' => ["id" => session()->get('users')->id],
                "Account_Name" => ["id" => session()->get('accounts')->id],
                "Contact_Name" => ["id" => session()->get('contacts')->id],
                "Campaign_Source" => ["id" => session()->get('campaigns')->id],
                "Type" => "New Business",
                "Description" => "Test deal Voldiner",
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

            if ($response->status() == 401) {
                $result['error'] = 'INVALID_TOKEN';
                return $result;
            } elseif ($response->status() == 201) {

                if (isset($response->object()->data[0]->code) && $response->object()->data[0]->code == "SUCCESS") {
                    $deal_id = $response->object()->data[0]->details->id;
                    session(['deal_id' => $deal_id]);
                    $result['deals'] = $response->object()->data[0];
                    return $result;
                }
            }
        }
        $result['error'] = 'UNKNOWN ERROR';
        return $result;


    }
}
