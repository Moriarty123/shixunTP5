<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use app\index\controller\Post;

class Comment extends Controller
{
    public function index()
    {
        
    }

    public function add()
    {
    	// dump($_POST);

        if (session('user_id') == NULL) {
            $this->error("请登录！", '/index/index/login',1);
        }

        //1.
        $content = input('post.content');
        $user_id = session('user_id');
        $post_id = input('post.post_id');
        $addTime = time();

        //2.
        
        //3.
        $data = [
            'user_id'   =>  $user_id,
            'post_id'   =>  $post_id,
            'content'   =>  $content,
            'addTime'   =>  $addTime
        ];

        $ret = db('comment')->insert($data);

        if($ret == false)
        {
            $this->error('添加评论失败！','',2);
        }

        $this->success('添加成功');

    }
    
}