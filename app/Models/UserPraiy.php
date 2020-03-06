<?php

namespace App\Models;

class UserPraiy extends Model
{
    protected $table = 'user_praiy';
    protected $fillable = ['uid'];
    protected $dateFormat = 'U';

    /**
     * 关联用户模型
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
}
