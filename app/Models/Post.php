<?php

namespace App\Models;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['user_id','title','content'];

    /**
     * @NOTES:关联用户表
     * @DESCRIPTION:文章所属用户
     * @AUTH:zhou.yh
     * @Date:2019/12/26 23:43
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    /**
     * @NOTES:关联评论模型
     * @DESCRIPTION:文章拥有的评论
     * @AUTH:zhou.yh
     * @Date:2019/12/26 23:42
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','post_id','id')->orderBy('created_at','desc');
    }

    /**
     * @NOTES:获取当前用户对应当前文章的点赞记录
     * @DESCRIPTION:一个文章针对一个用户只有一条点赞记录
     * @AUTH:zhou.yh
     * @Date:2019/12/30 22:12
     * @Version
     * @param $user_id
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function zan($user_id)
    {
        return $this->hasOne('App\Models\Zan','post_id','id')->where('user_id',$user_id);
    }

    /**
     * @NOTES:当前文章所有的点赞记录
     * @DESCRIPTION:一篇文章可以多条点赞记录
     * @AUTH:zhou.yh
     * @Date:2019/12/30 22:14
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zans()
    {
        return $this->hasMany('App\Models\Zan','post_id','id');
    }
}
