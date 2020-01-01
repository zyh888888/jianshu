<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dateFormat ="U";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"avatar"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @NOTES:用户拥有的文章列表
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:24
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Post','user_id','id');
    }

    /**
     * @NOTES:我的粉丝列表
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:28
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fans()
    {
        return $this->hasMany('App\Models\Fan','star_id','id');
    }

    /**
     * @NOTES:我的关注列表
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:30
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stars()
    {
        return $this->hasMany('App\Models\Fan','fan_id','id');
    }

    /**
     * @NOTES:关注某人
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:35
     * @Version
     * @param $uid
     * @return false|\Illuminate\Database\Eloquent\Model
     */
    public function doFan($uid)
    {
        $fan = new App\Models\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    /**
     * @NOTES:取消关注
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:45
     * @Version
     * @param $uid
     * @return mixed
     */
    public function doUnfan($uid)
    {
        $fan = new App\Models\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    /**
     * @NOTES:当前用户是否被某个uid关注
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:48
     * @Version
     * @param $uid
     * @return int 0：未被关注  1：已被关注
     */
    public function hasFan($uid)
    {
        return $this->fans()->where('fan_id',$uid)->count();
    }

    /**
     * @NOTES:当前用户是否关注了某个uid
     * @DESCRIPTION:
     * @AUTH:zhou.yh
     * @Date:2020/1/1 21:50
     * @Version
     * @param $uid
     * @return int 0：未关注  1：已关注
     */
    public function hasStar($uid)
    {
        return $this->stars()->where('star_id',$uid)->count();
    }




}
