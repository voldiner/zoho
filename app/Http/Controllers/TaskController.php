<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TaskController extends BaseController
{
    public function index()
    {
        $result = $this->create();
        if (isset($result['error'])) {
            return redirect()->route('home')->with(['error' => 'Create Task error ' . $result['error']]);
        }
        return redirect()->route('home')->with(['success' => 'Create Task success']);
    }

    public function create()
    {
        $result = [];
        if (!session()->has(['deal_id', 'users', 'contacts'])) {
            $result['error'] = 'Помилка! Спочатку необхідно виконати GetUser, Get Contact, Create deal ';
            return $result;
        }
        $url = 'https://www.zohoapis.com/crm/v2/Tasks';
        $token = $this->getToken();
        if ($token) {
            $array_param[] = [
                "Owner" => ["id" => session()->get('users')->id],
                "Who_Id" => ["id" => session()->get('contacts')->id],
                "What_Id" => ["id" => session()->get('deal_id')],
                '$se_module' => "deals",
                "Status" => "In Progress",
                "Send_Notification_Email" => true,
                "Description" => "Voldiner! test task",
                "Due_Date" => "2018-01-25",
                "Priority" => "Low",
                "send_notification" => true,
                "Subject" => "TestVoldiner",
                "Remind_At" => [
                    "ALARM" => "FREQ=NONE;ACTION=EMAIL;TRIGGER=DATE-TIME:2018-01-25T17:09:00+05:30"
                ]
            ];
            $parameters['data'] = $array_param;

            $response = Http::withToken($token)
                ->acceptJson()
                ->post($url, $parameters);
            //dd($response->object());
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
