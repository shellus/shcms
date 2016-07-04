<?php

namespace App\Http\Controllers;
use App\Jobs\SendReminderEmail;
use App\User;
use Request;

class IndexController extends Controller
{
    
    public function getIndex()
    {
        return view('index');
    }
    public function getTest(){
        view('index') ->setPath('');


        \LogicLog::info(Request::getClientIp() . '访问了测试接口');
        return ['ok'];
    }
}
