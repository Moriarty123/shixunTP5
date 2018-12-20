<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

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
        // $user_id = session('user_id');
        // dump($user_id);
        $where = "topic_id = {$topic}";
        // dump($where);
       
        // $ret = db('post')->where($where)->select();
        // dump($ret);
        // $ret = db('post')->where($where)->alias("a")->join("topic b", "a.topic_id = b.id")->join("user c", "a.user_id = c.id")->select();
        // $res = db('user')->where("id = 2")->select();
        // dump($res);
        $ret = db('post')->where($where)->alias("a")->join("user b", "a.user_id = b.id","LEFT")->field("a.*,b.phone")->select();
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


    //打开帖子详细信息
    public function getPostDetail()
    {
        //1.获取帖子信息
        //
        $id = input('get.id');
        //查询该id的帖子
        $Post = new Post();
        $post = $Post->getOnePost($id);
        
        //2.判断查看帖子次数，存入post_access表
        $request = Request::instance();
        $data = [
            'post_id'   =>  $post['id'],
            'ip'        =>  $request->ip(),
            'addTime'   =>  time() 
        ];
        $ret = db('post_access')->insert($data);
        $count = db('post_access')->count('ip');
        // dump($count);
        $this->assign('readnum', $count);
        //3.判断点赞次数
        //
        $this->assign('post', $post);

        //4.评论列表
        $comment = new Comment();
        $where = "post_id = {$id}";
        $ret = db('comment')->where($where)->alias("a")->join("user b", "a.user_id=b.id")->select();
        dump($ret);
        //5.显示所有回复
        $commentList = [];
        foreach ($ret as $key => $value) {
            $where = "comment_id = {$value['id']}";
            $reply = db('reply')->where($where)->alias("a")->join("user b", "a.user_id = b.id")->select();
            $value['reply'] = $reply;
            $commentList[] = $value;
        }
        
        // dump($commentList);

        $this->assign('commentList', $commentList);

        return $this->fetch('detail');
    }
}
