<?php
namespace app\admin\controller;

use app\admin\controller\Common;

class Carousel extends Common
{
	public function index()
	{
		return view('carouselAdd');
	}

	public function insert()
	{

		// dump($_POST);
		// dump($_FILES);

		//1.保存轮播图片
		//1.1 获取表单上传文件
		$file = request()->file('pictureUploads');
		// dump($file);
		if ($file == NULL) {
			$this->error('未选择图片');
		}
		
		//1.2 移动到框架应用根目录/public/uploads/ 目录下
		if($file){
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				// 成功上传后 获取上传信息
				$img_path = "/uploads/{$info->getSaveName()}";
				// $this->success('上传成功!'.$img_path);
			}else{
				// 上传失败获取错误信息
				$this->error($file->getError());
			}
		}

		//2.验证数据
		//2.1获取表单数据
		$title = input('post.pictureTitle');
		$link = input('post.pictureLink');
		$number = input('post.pictureNumber');
		$url = $img_path;
		$addTime = time();
		$status = 1;
		//2.2验证数据
		//TO DO


		//3.存入数据库
		//3.1要存入的数据
		$data = [
			'title'		=>	$title,
			'link'		=>	$link,
			'number'	=>	$number,
			'url'		=>	$url,
			'addTime' 	=>	$addTime,
			'status'	=>	$status
		];

		//3.2存入carousel表
		$ret = db('carousel')->insert($data);

		if ($ret != true) {
			$this->error('添加轮播图片失败！');
		}
		else {
			$this->success('添加轮播图片成功！','admin/carousel/alist');
		}
	}

	//轮播图片列表
	public function alist() 
	{
		//查看所有轮播图片
		$pictureList = db('carousel')->paginate(3);

		$this->assign('pictureList', $pictureList);

		return view('carouselList');
	}

	//删除图片
	public function delete() 
	{
		$id = input('get.id');

		$where = "id={$id}";

		$ret = db('carousel')	->where($where)
								->delete();

		if ( $ret == false) {
			$this->error('删除失败！');
		}

		$this->success('删除成功！');
	}

	//跳转到编辑页面
	public function edit() 
	{
		$id = input('get.id');

		$where = "id={$id}";
		$carousel = db('carousel')	->where($where)
									->find();

		$this->assign('carousel', $carousel);

		return view('carouselEdit');
	}

	//更新图片
	public function update()
	{
		//1.验证数据
		//1.1获取表单数据
		$id = input('post.pictureId');
		$title = input('post.pictureTitle');
		$link = input('post.pictureLink');
		$number = input('post.pictureNumber');
		$url = input('post.pictureUploads');
		$addTime = time();



		//1.2验证数据
		//TODO
		

		//2.更新数据
		//2.1要存入的数据
		$data = [
			'title'		=>	$title,
			'link'		=>	$link,
			'number'	=>	$number,
			'url'		=>	$url,
			'addTime' 	=>	$addTime
		];

		//2.2存入carousel表
		$where = "id={$id}";
		$ret = db('carousel') ->where($where)
					          ->update($data);

		if ($ret != true) {
			$this->error('更新轮播图片失败！');
		}
		else {
			$this->success('更新轮播图片成功！','admin/carousel/alist');
		}
	}

	//上传图片
	public function uploadsimage() {
		// dump($_POST);
		// dump($_FILES);
		$file = request()->file('image');
		// dump($file);
		if ($file == NULL) {
			$this->error('未选择图片');
		}
		
		//1.2 移动到框架应用根目录/public/uploads/ 目录下
		if($file){
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info){
				// 成功上传后 获取上传信息
				$img_path = "/uploads/{$info->getSaveName()}";
				echo $img_path;
				// $this->success('上传成功!'.$img_path);
			}else{
				// 上传失败获取错误信息
				$this->error($file->getError());
			}
		}
	}
}
