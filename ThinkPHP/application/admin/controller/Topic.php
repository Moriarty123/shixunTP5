<?php 

namespace app\admin\controller;

use app\admin\controller\Common;

class Topic extends Common
{
	public function add()
	{
		return $this->fetch('topicAdd');
	}

	public function insert()
	{
		// dump($_POST);
		// dump($_FILES);

		//1.获取表单数据
		$name 	 = input('post.topicName');
		$number  = input('post.topicNumber');
		$image 	 = input('post.topicImage');
		$content = input('post.topicContent');
		$addTime = time();

		//2.验证数据
		
		//3.存入数据库
		//3.1构造数据
		$data = [
			'name' 		=> 	$name,
			'number'	=>	$number,
			'image'		=>	$image,
			'content'	=>	$content,
			'addTime'	=>	$addTime
		];

		//3.2存入数据库
		$ret = db('topic')->insert($data);

		if ($ret == false) {
			//存入数据库失败
			$this->error('添加话题失败！');
		}

		//4.后续操作
		$this->success("添加话题成功！");
		// dump($data);

	}

	public function aList()
	{
		$topicList = db('topic')->paginate(3);

		$this->assign('topicList', $topicList);

		return $this->fetch('topicList');
	}
}