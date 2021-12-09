<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AccountController extends BaseController
{
    public function index()
    {
        $result = $this->getRecord('Accounts');
        if (isset($result['error'])){
            return redirect()->route('home')->with(['error' => 'Account error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Get Account success']);
    }


}
