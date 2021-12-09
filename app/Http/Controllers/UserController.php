<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends BaseController
{
    public function index()
    {
        $result = $this->getUser();

        if (isset($result['error'])){
            return redirect()->route('home')->with(['error' => 'User error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Get User success']);
    }

    /**
     *
     * отримати першу запис для створення deal
     * @return array
     */
    public function getUser()
    {
        $result = [];
        $url = 'https://www.zohoapis.com/crm/v2/users';
        $token = $this->getToken();
        if ($token) {
            $response = Http::withToken($token)
                ->acceptJson()
                ->get($url);
            if ($response->status() == 401) {
                $result['error'] = 'INVALID_TOKEN';
                return $result;
            } elseif ($response->status() == 200) {
                if (isset($response->object()->users[0])) {
                    $user = $response->object()->users[0];
                    session(['users' => $user]);
                    $result['users'] = $user;
                    return $result;
                }
            }
        }
        $result['error'] = 'UNKNOWN ERROR';
        return $result;

    }
}
