<?php

namespace App\Models;


class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id','post_id','content'];

    /**
     * @NOTES:关联文章模型
     * @DESCRIPTION:评论所属文章
     * @AUTH:zhou.yh
     * @Date:2019/12/26 23:47
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post','post_id','id');
    }

    /**
     * @NOTES:关联用户模型
     * @DESCRIPTION:评论所属用户
     * @AUTH:zhou.yh
     * @Date:2019/12/27 0:42
     * @Version
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
