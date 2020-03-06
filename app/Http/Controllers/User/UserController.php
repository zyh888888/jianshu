<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Models\Fan;
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

    //个人中心页面
    public function show(User $user)
    {
        //这个人的信息 包含关注、粉丝、文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);

        //这个人的文章列表，取创建时间最新的前10条
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

        //这个人关注的用户 包含用户的关注、粉丝、文章数
        $stars = $user->stars();
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //这个人的粉丝用户 包含粉丝用户的关注、粉丝、文章数
        $fans = $user->fans();
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','susers','fusers'));
    }

    //关注某人
    public function fan(User $user)
    {
        $me = \Auth::user();
        $me->doFan($user->id);
        return ['error'=>0,'msg'=>''];
    }

    //取消关注
    public function unfan(User $user)
    {
        $me = \Auth::user();
        $me->doUnfan($user->id);
        return ['error'=>0,'msg'=>''];
    }

    /**
     * 测试
     * @return mixed
     */
    public function test()
    {
        $keyword = 'u';
        $users = User::where(function($query) use ($keyword){
            $query->where('name','like','%'. $keyword .'%')
                ->orWhere('nickname','like','%'. $keyword .'%');
        })->get();

        $where[] = ['in'=>['fan_id'=>$users->pluck('id')]];
        $orWhere[] = ['in'=>['star_id'=>$users->pluck('id')]];

        $lists = Fan::where($where)->
        orWhere($orWhere)->
        orderBy('id','desc')->paginate(6);
        return $lists;
    }

}
