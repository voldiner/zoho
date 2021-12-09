<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CampaignController extends BaseController
{
    public function index()
    {
        $result = $this->getRecord('Campaigns');
        if (isset($result['error'])){
            return redirect()->route('home')->with(['error' => 'Campaign error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Get Campaign success']);
    }

}
