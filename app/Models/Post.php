<?php

namespace App\Models;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['user_id','title','content'];

    /**
     * @NOTES:反向关联用户表
     * @AUTH:zhou.yh
     * @Date:2019/12/22 13:03
     * @Version
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
