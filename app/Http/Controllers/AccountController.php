<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AccountController extends BaseController
{
    public function index()
    {
        $this->getRecord('Accounts');
        return redirect('/');
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
