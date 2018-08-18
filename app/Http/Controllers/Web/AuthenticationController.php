<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    //
    public function getSocialRedirect($account)
    {
        try {
            \Log::info($account);
            return Socialite::with($account)->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/login');
        }
    }

    public function getSocialCallback($account)
    {
        // 从第三方 OAuth 回调中获取用户信息
        $socialUser = Socialite::with($account)->user();
        // 在本地 users 表中查询该用户来判断是否已存在
        $user = User::where('github_id', '=', $socialUser->id)->first();
        if ($user == null) {
            $newUser = new User();
            $newUser->name = $socialUser->getNickname();
            $newUser->email = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar = $socialUser->getAvatar();
            $newUser->password = '';
            $newUser->github_name = $socialUser->getNickname();
            $newUser->github_id = $socialUser->getId();
            $newUser->github_url = $socialUser->user['url'];

            $newUser->save();
            $user = $newUser;
        }
        // 手动登录该用户
        Auth::login($user);

        // 登录成功后将用户重定向到首页
        return redirect('/#/Home');
    }
}
