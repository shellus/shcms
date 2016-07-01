<?php

namespace App\Http\Controllers\Auth;
use App\OAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Overtrue\Socialite\SocialiteManager;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OAuthController extends Controller
{
    public function getAuthorize($type){
        $socialite = new SocialiteManager([
            $type => config('services.' . $type),
        ]);
        $response = $socialite->driver($type)->redirect();
        return $response;
    }
    public function postAccessToken($type){
        $socialite = new SocialiteManager([
            $type => config('services.' . $type),
        ]);
        /** @var \Overtrue\Socialite\UserInterface $o_user */
        $o_user = $socialite->driver($type)->user();

//        \Auth::attempt(['auth_'.$type.'_key']);
        // todo 如何新建用户？
        if($oauth = OAuth::whereType($type) -> whereOauthId($o_user -> getId()) -> first()){
            $user = \Auth::loginUsingId($oauth -> user_id);
        }else{
            $this -> create_user($o_user, $type);
        }

        return redirect(route('index'));
    }

    /**
     * @param \Overtrue\Socialite\UserInterface $o_user
     * @param $type
     */
    private function create_user($o_user, $type){
        $oauth_data = [
            'type' => $type,
            'oauth_id' => $o_user -> getId(),
            'payload' => $o_user -> toJSON(),
            'user_id' => User::create([
                'name' => $user_id = $o_user -> getNickname(),
            ]) -> id,
        ];
        $oauth = OAuth::create($oauth_data);
        $user = \Auth::loginUsingId($oauth -> user_id);
    }
}
