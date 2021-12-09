<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
}
