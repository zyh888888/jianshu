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
}
