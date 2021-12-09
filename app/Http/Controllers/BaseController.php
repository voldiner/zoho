<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BaseController extends Controller
{
    public function getToken()
    {
        if (!session()->has('token')) {
            $this->refreshToken();
        }
        $result = session()->has('token')? session('token') : false;
        return $result;
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
        if ($response->status() == 200 && isset($response->object()->access_token)){
            $token = $response->object()->access_token;
            session()->put('token', $token);
            return $token;
        }

        return 'ERROR_TOKEN';
    }

    /**
     * @param string $name
     * отримати першу запис для створення deal
     * @return array
     */
    public function getRecord($name)
    {
        $result = [];
        $url = 'https://www.zohoapis.com/crm/v2/' . $name;
        $token = $this->getToken();
        if ($token){
            $response = Http::withToken($token)
                ->acceptJson()
                ->get($url);
            if ($response->status()== 401){
                $result['error'] = 'INVALID_TOKEN';
                return $result;
            }elseif ($response->status()== 200){
                if (isset($response->object()->data[0])) {
                    $item = $response->object()->data[0];
                    $key = Str::lower($name);
                    session([ $key => $item]);
                    $result[$key] = $item;
                    return $result;
                }
            }
        }
        $result['error'] = 'UNKNOWN ERROR';
        return $result;
    }
}
