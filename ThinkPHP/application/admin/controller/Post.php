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
}