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
     * @NOTES:保存文章
     * @AUTH:zhou.yh
     * @Date:2019/12/15 21:11
     * @Version
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        //1 数据校验
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);

        //2 逻辑
        $user_id = \Auth::id();
        $param = array_merge(request(['title','content']),compact('user_id'));
        $post = Post::create($param);

        //3 渲染
        return redirect('/posts');
    }

    //编辑
    public function edit(Post $post)
    {
        return view('post/edit',['post'=>$post]);
    }

    /**
     * @NOTES:上传图片
     * @AUTH:zhou.yh
     * @Date:2019/12/15 23:20
     * @Version
     */
    public function uploadImg(Request $request)
    {
        //创建图片存储路径
        $path = 'image/'.date('Y').'/'.date('m').'/'.date('d');
        $rule = ['jpg', 'png', 'gif'];

        //获取图片信息
        $file = $request->file('wangEditorH5File');
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
            return asset('/storage/'.$path);
        }
    }

    /**
     * @NOTES:更新文章
     * @AUTH:zhou.yh
     * @Date:2019/12/19 22:48
     * @Version
     */
    public function update(Post $post)
    {
        //1 数据校验
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:10'
        ]);

        //2 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //策略判断
        $this->authorize('update',$post);

        //渲染
        //返回文章详情页面
        return redirect("/posts/{$post->id}");
    }

    /**
     * @NOTES:删除文章
     * @AUTH:zhou.yh
     * @Date:2019/12/19 23:20
     * @Version
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete(Post $post)
    {
        //策略判断
        $this->authorize('delete',$post);
        //逻辑
        $post->delete();
        //渲染
        return redirect('/posts');
    }

}
