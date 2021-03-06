<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Common extends Controller
{
    //上传图片
	public function uploadsimage() 
	{
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

	public function common(){
   		return $this->fetch('common');
	}

    
    
}
