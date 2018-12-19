<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

use app\index\controller\Topic;

class Post extends Controller
{
	public function _initialize() 
	{
		// if (session('user_id') == NULL) {
		// 	$this->error("请登录！", '/index/index/login');
		// }
	}

    public function index()
    {
        $topic = new Topic();
        $topicList = $topic->getAllTopic();

        $this->assign('topicList', $topicList);

        return $this->fetch('postAdd');
    }

    public function add()
    {
    	// dump($_POST);
    	// dump($_FILES);
    	//1.获取表单数据
    	$title = input('post.title');
        $topic = input('post.topic');
        // dump($topic);
    	$images = input('post.pictureUploads');
    	$content = input('post.editorValue');


        $images = explode(',', $images);
    	// $srcs =	explode(',', $pictures);
    	// dump($srcs);

    	//2.验证
    	//TODO
    	
    	//3.存入post表
    	$data = [
    		'user_id'	=>	session('user_id'),
    		'title'		=>	$title,
            'topic_id'=>  $topic,
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

    public function hotPostList()
    {
        $where = "is_index = 1";

        $hotPostList = db('post')->where($where)->select();

        $temp = [];
        foreach ($hotPostList as $key => $value) {
            $temp = json_decode($value['images']);
            // dump($temp);
            $value['images'] = $temp;
            // dump($value);
            $hotPostList[$key] = $value;
        }

        return $hotPostList;


    } 

    public function getOneHotPost($page) 
    {
        
        $where = "id = {$page}";

        $ret = db('post')->where($where)->find();

        if ($ret == false) {
            $this->error('查找失败！');
        }
        // echo $ret;
        // $this->success('查找成功！');
        return $ret;

    }

    public function getTopicPost($topic)
    {
        $where = "topic_id = {$topic}";
        // dump($where);
        $ret = db('post')->where($where)->select();
        // dump($ret);
        //只获取第一张图片
        $temp = [];
        $postList = [];
        foreach ($ret as $key => $post) {
            $temp = $post;
            $images = json_decode($post['images']);
            $image = $images[0];

            $temp['image'] = $image;
            $postList[] = $temp;
        }

        // dump($temp);

        return $postList;
    }

    //查找一个帖子
    public function getOnePost($id)
    {
        $where = "id = {$id}";

        $post = db('post')->where($where)->find();

        return $post;
    }
}
