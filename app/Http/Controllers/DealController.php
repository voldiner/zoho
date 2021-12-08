<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DealController extends Controller
{
    public function create()
    {
        dump(session()->all());

        $url = 'https://www.zohoapis.com/crm/v2/Deals';
        $token = $this->getToken();
        //$response = Http::withToken($token)->get($url);
        //dd($response->object()->status); // 'error'
        //dd($response->object()->data[0]->id); // 'error'
        // ---- create deal
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

    public function refreshToken()
    {
        $url = 'https://accounts.zoho.com/oauth/v2/token';

        $response = Http::asForm()->post($url, [
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'refresh_token' => env('REFRESH_TOKEN'),
            'grant_type' => 'refresh_token',
        ]);
        $token = $response->object()->access_token;
        session()->put('token', $token);
        return $token;
    }

    /**
     *
     * отримати першого користувача для створення deal
     */
    public function getUser()
    {
        $url = 'https://www.zohoapis.com/crm/v2/users';
        $token = $this->getToken();
        $response = Http::withToken($token)
            ->acceptJson()
            ->get($url);

        if (isset($response->object()->users[0])) {
            $user = $response->object()->users[0];
            session()->put('user_id', $user->id);
            return $user;
        }
        return false;
    }

    /**
     * @param string $name
     * отримати першу запис для створення deal
     * @return object|false
     */
    public function getRecord($name)
    {
        $url = 'https://www.zohoapis.com/crm/v2/' . $name;
        $token = $this->getToken();
        $response = Http::withToken($token)
            ->acceptJson()
            ->get($url);

        if (isset($response->object()->data[0])) {
            $item = $response->object()->data[0];
            $key = Str::lower($name) . '_id';
            session([ $key => $item->id]);
            return $item;
        }
        return false;
    }


    /**
     * @return string $result
     */
    public function getToken()
    {
        if (!session()->has('token')) {
            $this->refreshToken();
        }
        $result = session('token');
        return $result;
    }

}
