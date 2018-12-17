<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Post extends Controller
{
	public function _initialize() 
	{
		if (session('user_id') == NULL) {
			$this->error("请登录！", '/index/index/login');
		}
	}

    public function index()
    {
        return $this->fetch('postAdd');
    }

    public function add()
    {
    	// dump($_POST);
    	// dump($_FILES);
    	//1.获取表单数据
    	$title = input('post.title');
    	$images = input('post.pictureUploads');
    	$content = input('post.editorValue');

    	// dump($title);
    	// dump($pictures);
    	// dump($editorValue);

        $images = explode(',', $images);
    	// $srcs =	explode(',', $pictures);
    	// dump($srcs);

    	//2.验证
    	//TODO
    	
    	//3.存入post表
    	$data = [
    		'user_id'	=>	session('user_id'),
    		'title'		=>	$title,
    		'images'	=>	json_encode($images),
    		'content'	=>	$content,
    		'addTime'	=>	time(),
    		'is_index'	=>	0
    	];

    	$ret = db('post')->insert($data);

    	if ($ret == false) {
    		$this->error('发布帖子失败！');
    	}

    	$this->success('发布帖子成功！');

    }
}
