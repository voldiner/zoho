<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ContactController extends BaseController
{
    public function index()
    {
        $result = $this->getRecord('Contacts');
        if (isset($result['error'])){
            return redirect()->route('home')->with(['error' => 'Contact error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Get Contact success']);
    }

}
