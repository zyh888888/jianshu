<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    //文章列表
    public function index()
    {
        $posts = Post::orderBy('created_at')->paginate(6);
        return view("post/index",['posts'=>$posts]);
    }

    //文章详情页面
    public function show(Post $post)
    {
        return view('post/show', ['post'=>$post]);
    }

    //创建文章
    public function create()
    {
        return view('post/create');
    }

    //保存文章
    public function store()
    {
        dd(request());
    }

    //编辑
    public function edit()
    {
        return view('post/edit');
    }
}
