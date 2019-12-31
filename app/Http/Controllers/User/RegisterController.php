<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class RegisterController extends Controller
{
    /**
     * @NOTES:注册页面
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:49
     * @Version
     */
    public function index()
    {
        return view('register.index');
    }

    /**
     * @NOTES:注册行为
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:50
     * @Version
     */
    public function register()
    {
        //验证
        $rules = [
            "name" => 'required|min:3|max:10|unique:users,name',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:3|max:10|confirmed',
        ];
        $this->validate(request(),$rules);

        //逻辑
        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));
        $user = User::create(compact('name','email','password'));

        //渲染
        return redirect('/login');
    }
}
