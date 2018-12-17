<?php
namespace app\admin\controller;

use app\admin\controller\Common;

class Post extends Common
{
	public function alist() 
	{

		$postList = db('post')->paginate(3);

		$temp = [];
		foreach ($postList as $key => $value) {
			$temp = json_decode($value['images']);
			// dump($temp);
			$value['images'] = $temp;
			// dump($value);
			$postList[$key] = $value;
		}

		// dump($postList);

		$this->assign('postList', $postList);

		return $this->fetch('postList');
	}

	public function deletePost()
	{
		$id = input('get.id');
		$where = "id = {$id}";

		$ret = db('post')->where($where)->delete();

		if ($ret == false) {
			$this->error('删除帖子失败！');
		}

		$this->success('删除帖子成功！');

	}

	//推荐热帖
	public function inIndex()
	{
		$id = input('get.id');
		$where = "id = {$id}";

		$post = db('post')->where($where)->find();

		if($post['is_index'] == 0) {
			$post['is_index'] = 1;
		} 
		else {
			$post['is_index'] = 0;
		}

		$ret = db('post')->where($where)->update($post);

		if ($ret == false) {
			$this->error('推荐帖子失败！');
		}

		if($post['is_index'] == 0) {
			$this->success('取消推荐成功！');
		}
		else {
			$this->success('推荐帖子成功！');
		}

	}
}