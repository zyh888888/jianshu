<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //文章列表
    public function index()
    {
        $posts = [
            ['id'=>1,'uid'=>5,'title'=>'title1','content'=>'这是第1个标题的内容'],
            ['id'=>2,'uid'=>6,'title'=>'title2','content'=>'这是第2个标题的内容'],
            ['id'=>3,'uid'=>7,'title'=>'title3','content'=>'这是第3个标题的内容'],
            ['id'=>4,'uid'=>8,'title'=>'title4','content'=>'这是第4个标题的内容'],
            ['id'=>5,'uid'=>9,'title'=>'title5','content'=>'这是第5个标题的内容'],
        ];
        return view("post/index",['posts'=>$posts]);
    }

    //文章详情页面
    public function show()
    {
        return view('post/show', ['title' => 'this is 标题', 'isShow' => true]);
    }

    //创建文章
    public function create()
    {
        return view('post/create');
    }

    public function store()
    {

    }

    //编辑
    public function edit()
    {
        return view('post/edit');
    }
}
