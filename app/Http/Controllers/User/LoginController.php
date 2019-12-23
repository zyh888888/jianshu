<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * @NOTES:登录页面
     * @AUTH:zhou.yh
     * @Date:2019/12/22 1:26
     * @Version
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if(\Auth::check()){
            return redirect("/posts");
        }
        return view('login.index');
    }

    /**
     * @NOTES:登录行为
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:51
     * @Version
     */
    public function login()
    {
        //表单验证
        $rules = [
            "email" => 'required|email',
            "password" => 'required|min:3|max:10',
            'is_remember' => "integer",
        ];
        $this->validate(request(),$rules);

        //逻辑
        $user = request(['email','password']);
        $is_remember = boolval(request("is_remember"));
        if(\Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        };
        //渲染
        return back()->withErrors('邮箱密码不匹配');
    }

    /**
     * @NOTES:登出行为
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:51
     * @Version
     */
    public function logout()
    {
        \Auth::logout();
        return redirect('/login');
    }
}
