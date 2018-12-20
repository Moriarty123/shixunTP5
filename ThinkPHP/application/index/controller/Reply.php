<?php
namespace app\index\controller;

use think\Controller;
class Reply extends Controller
{
	public function index() 
	{
		return $this->fetch();
	}

	public function add()
	{
		if (session('user_id') == NULL) {
            $this->error("请登录！", '/index/index/login',1);
        }

        //1.
        $content = input('post.content');
        $user_id = session('user_id');
        $post_id = input('post.post_id');
        $comment_id = input('comment_id');
        $addTime = time();

        //2.
        
        //3.
        $data = [
            'user_id'   =>  $user_id,
            'post_id'   =>  $post_id,
            'comment_id'=>	$comment_id,
            'content'   =>  $content,
            'addTime'   =>  $addTime
        ];

        $ret = db('reply')->insert($data);

        if($ret == false)
        {
            $this->error('回复失败！','',2);
        }

        $this->success('回复成功');
	}
} 