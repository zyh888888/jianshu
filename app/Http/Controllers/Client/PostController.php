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
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view("post/index",['posts'=>$posts]);
    }

    //文章详情页面
    public function show(Post $post)
    {
        return view('post/show', ['post'=>$post]);
    }

    //创建文章页面
    public function create()
    {
        return view('post/create');
    }

    /**
     * @NOTES:保存文章逻辑
     * @AUTH:zhou.yh
     * @Date:2019/12/15 21:11
     * @Version
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        //1数据校验
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);
        //2 保存数
        $post = Post::create(request(['title','content']));
        //3 return 文章列表页面
        return redirect('/posts');
    }

    //编辑
    public function edit()
    {
        return view('post/edit');
    }
}
