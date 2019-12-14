<?php


namespace App\Services;

use App\Models\UserPraiy;
use Illuminate\Support\Facades\DB;
class UserPraiyService
{
    private $userPraiyModel;

    public function __construct(UserPraiy $userPraiy)
    {
        $this->userPraiyModel = $userPraiy;
    }

    public function getList($where,$limit = 10)
    {
        $sql = DB::raw('count(*) as num');
        $praiys = $this->userPraiyModel
            ->where($where)
            ->groupBy('user_id')
            ->select("user_id",$sql)
            ->orderBy('num','desc')
            ->paginate($limit);
        return $praiys;
    }
}
