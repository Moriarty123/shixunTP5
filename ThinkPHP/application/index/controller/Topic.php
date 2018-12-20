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
        $id = input('get.post_id');
        // dump($id);
        //查询该id的帖子
        $Post = new Post();
        $post = $Post->getOnePost($id);
        // dump($post);
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
        // dump($where);
        $ret = db('comment')->where($where)->alias("a")
        ->join("user b", "a.user_id=b.id", "LEFT")
        ->field("a.*, b.phone")
        ->select();
        // dump($ret);
        //5.显示所有回复
        $commentList = [];
        foreach ($ret as $key => $value) {
            $where = "comment_id = {$value['id']}";
            $reply = db('reply')->where($where)->alias("a")
            ->join("user b", "a.user_id = b.id")
            ->join("comment c", "a.comment_id = c.id")
            ->field("a.*, b.phone")
            ->select();
            // dump(db('reply')->getlastsql());
            // dump($reply);
            $value['reply'] = $reply;
            $commentList[] = $value;
            // dump($commentList);
        }
        
        // dump($commentList);

        $this->assign('commentList', $commentList);

        return $this->fetch('detail');
    }

    //关注话题
    public function topicFollow()
    {
    	// dump($_POST);
    	if (session('user_id') == NULL) {
			$this->error("请登录！", '/index/index/login',1);
		}
		
    	//获取数据
    	$user_id = session('user_id');
    	$topic_id = input('post.topic_id');
    	

    	$where = "user_id = {$user_id} and topic_id = {$topic_id}";
    	$ret = db('TopicFollow')->where($where)->find();

    	if( empty($ret) )
    	{
    		$data = [
    			'user_id' => $user_id,
    			'topic_id'=> $topic_id,
    			'addTime' => time() 
    		];
    		$res = db('TopicFollow')->insert($data);
    	}
    	else {
    		$res = db('TopicFollow')->where($where)->delete();
    		$this->error('已关注该话题',"", 3);
    	}

    	if ($res == false) {
    		$this->error("关注话题失败","",2);
    	}

    	$this->success('关注话题成功');
    }
}