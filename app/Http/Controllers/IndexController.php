<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function clear()
    {
        session()->forget(['users', 'accounts','contacts', 'campaigns', 'deal_id']);
        return view('index');
    }
}
