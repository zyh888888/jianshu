<?php

namespace App\Models;


class Fan extends Model
{
    /**
     * @NOTES:关联用户模型
     * @DESCRIPTION:获取fan模型对应的粉丝模型
     * @AUTH:zhou.yh
     * @Date:2020/1/1 22:05
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fuer()
    {
        return $this->hasOne('App\User','id','fan_id');
    }

    /**
     * @NOTES:关联用户模型
     * @DESCRIPTION:获取fan模型对应的被关注用户模型
     * @AUTH:zhou.yh
     * @Date:2020/1/1 22:06
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function suer()
    {
        return $this->hasOne('App\User','id','star_id');
    }
}
