<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;

class Common extends Controller
{

    public function _initialize()
    {
        $id = session('admin_id');

    	if($id == NULL) {
    		$this->error('请登录！', 'admin/login/index');
    	}

    	

    	$loginTime = session('loginTime');
    	if(time() - $loginTime > 3000) {
    		$this->error('登录超时，请重新登录！', 'admin/login/index');
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
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads' . DS .'topic');
            if($info){
                // 成功上传后 获取上传信息
                $img_path = "/uploads/topic/{$info->getSaveName()}";
                echo $img_path;
                // $this->success('上传成功!'.$img_path);
            }else{
                // 上传失败获取错误信息
                $this->error($file->getError());
            }
        }

        // return $img_path;
    }

}