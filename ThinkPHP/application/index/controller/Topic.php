<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Request;

class Topic extends Controller
{
    public function index()
    {
        $topicList = db('topic')->paginate(3);

        $this->assign('topicList', $topicList);

        return $this->fetch('topicList');
    }

    public function topic()
    {
    	return $this->fetch('topic');
    }
    

    public function getAllTopic()
    {
    	$ret = db('topic')->select();

    	return $ret;
    }

    public function getPostList()
    {
        $topic_id = input('get.topic');
        // dump($topic_id);
       //获取特定话题的帖子
       $post = new Post();
       $postList = $post->getTopicPost($topic_id);

       // dump($postList);

       $this->assign('postList', $postList);
       return $this->fetch('postList');
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

        return $this->fetch('detail');
    }
}
