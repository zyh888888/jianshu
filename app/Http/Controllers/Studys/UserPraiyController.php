<?php


namespace App\Http\Controllers\Studys;

use App\Services\UserPraiyService;

class UserPraiyController
{


    public function getList(UserPraiyService $userPraiyService)
    {
        $where = [];
        $result = $userPraiyService->getList($where);
        return view('studys.belongsTo',['list'=>$result]);
    }
}
