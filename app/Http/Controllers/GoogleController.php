<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Socialite;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class GoogleController extends Controller
{   
    /**
     * 重導使用者到 Google 認證頁。
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 從 Google 得到使用者資訊
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        if($user = Socialite::driver('google')->user()){
            if($find_user = User::select()->where('email','=',$user->email)->first()){
                Auth::login($find_user);
            }else if(preg_match("/@gm.nfu.edu.tw/",$user->email)){
                $add_user = User::create([
                    'name' => $user->name,
                    'email' => $user->email
                ]);
                Auth::login($add_user);
            }else {
                return redirect()->back()->with([
                    'errTitle' => '信箱位置錯誤',
                    'errMes_header' => "請使用",
                    'errMes_content' => "虎尾科大信箱",
                    'errMes_footer' => "登入!"
                ]);
            }
            // Storing user infomation to log
            Log::create([
                'logInAC' => Auth::user()->email,
                'logInTime' => Carbon::now(),
                'IP' => $_SERVER['REMOTE_ADDR']
            ]);
            return redirect()->route('home');
            // $user->token;
        }
    }

}