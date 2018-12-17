<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use app\index\controller\Post;

class Index extends Controller
{
    public function index()
    {
    	$post = new Post();
    	$hotPostList = $post->hotPostList();

    	$this->assign('hotPostList', $hotPostList);
    	
        return $this->fetch();
    }

    public function login()
    {
    	return $this->fetch('login');
    }
    
}
