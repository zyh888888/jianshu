<?php


namespace App\Services;


class ImageUploadService
{
    public function uploadImg($request,$filename = 'file')
    {
        //创建图片存储路径
        $path = 'image/'.date('Y').'/'.date('m').'/'.date('d');
        $rule = ['jpg', 'png', 'gif'];

        //获取图片信息
        $file = $request->file($filename);
        if($file->isValid()){
            $clientName = $file->getClientOriginalName();//获取文件名
            $tmpName = $file->getFileName();
            $realPath = $file->getRealPath();
            $entension = $file->getClientOriginalExtension();//获取图片后缀
            if (!in_array($entension, $rule)) {
                return '图片格式为jpg,png,gif';
            }

            //存储图片
            $path = $file->storePublicly($path.'/'.md5(date("Y-m-d H:i:s") . $clientName));
            //返回图片路径
            return asset('storage/'.$path);
        }
    }
}
