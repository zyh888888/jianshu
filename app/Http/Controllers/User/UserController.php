<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

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
        $user = \Auth::user();
        return view('user.setting',compact('user'));
    }

    /**
     * @NOTES:个人设置操作
     * @AUTH:zhou.yh
     * @Date:2019/12/21 23:52
     * @Version
     */
    public function settingStore(Request $request,ImageUploadService $imageUploadService)
    {
        //验证
            $rules = [
                "name" => 'required|min:3|max:10',
            ];
            $this->validate(request(),$rules);
        //逻辑
        $name = request('name');
        $user =\Auth::user();

        if($name != $user->name){
            if(User::where('name',$name)->count() > 0){
                return back()->withErrors($name.':该用户名已经被注册');
            }
            $user->name = $name;
        }

        if($request->file('avatar')){
            $user->avatar = $imageUploadService->uploadImg($request,'avatar');
        }
        $user->save();

        //渲染
        return back();
    }
}
