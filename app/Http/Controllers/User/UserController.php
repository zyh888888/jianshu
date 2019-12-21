<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @NOTES:个人设置页面
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:52
     * @Version
     */
    public function setting()
    {
        return view('user.setting');
    }

    /**
     * @NOTES:个人设置操作
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:52
     * @Version
     */
    public function settingStore()
    {

    }
}
