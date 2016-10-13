<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $fillable = [
        'user_id','login_ip','remember','user_agent','referer','connection',
    ];
}
