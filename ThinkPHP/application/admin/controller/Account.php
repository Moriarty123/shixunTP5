<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;

class Account extends Controller
{
    public function index()
    {
        return view();
    }

    public function insert()
    {
    	//1.保存头像图片
        //1.1 获取表单上传文件
	    $file = request()->file('Head_img');
	    // dump($file);
	    if ($file == NULL) {
	    	$this->error('未选择头像');
	    }
	    
	    //1.2 移动到框架应用根目录/public/uploads/ 目录下
	    if($file){
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
	        if($info){
	            // 成功上传后 获取上传信息
	            $img_path = "/uploads/{$info->getSaveName()}";
	        }else{
	            // 上传失败获取错误信息
	            $this->error($file->getError());
	        }
	    }

	    //2 验证数据
	    //2.1 获取表单数据
	    $userName = input('userName', '','htmlspecialchars');
	    $email = input('email', '','htmlspecialchars');
	    $telephone = input('telephone', '','htmlspecialchars');
	    $pwd = input('pwd', '','htmlspecialchars');
	    $repwd = input('repwd', '','htmlspecialchars');

	    //2.2 建立验证器
	    //定义验证规则
	    $rule = [
	    	'userName'			=>	'require',
	    	'email|邮箱'		=>	'email|unique:admin',
	    	'telephone|手机号'	=>	'length:11|unique:admin',
	    	'pwd|密码'			=>	'require|min:6',
			'repwd|确认密码'	=>	'require|min:6|confirm:pwd'
	    ];

	    //定义报错信息
	    $msg = [
	    	'userName.require'	=>	'用户名不能为空！',
	    	'email.email'		=>	'邮箱格式不正确',
	    	'email.unique'		=>	'该邮箱已被注册',
	    	'telephone.length'	=>	'手机号必须为11位',
	    	'telephone.unique'	=>	'该手机号已被注册',
	    	'pwd.require'		=>	'密码不能为空！',
			'pwd.min'			=>	'密码最少为6位',
			'repwd.require'		=>	'请确认密码',
			'repwd.min'			=>	'确认密码最少为6位',
			'repwd.confirm'		=>	'两次密码不一致'
	    ];

	    //要验证的数据
	    $check = [
	    	'userName'	=>	$userName,
	    	'email'		=>	$email,
	    	'telephone'	=>	$telephone,
	    	'pwd'		=>	$pwd,
			'repwd'		=>	$repwd,
	    	'headImg'	=>	$img_path	
	    ];

	    //创建验证器
		$validate = new Validate($rule, $msg);

		//返回验证结果
		$res = $validate->check($check);
		
		//输出错误信息
		if ($res != true) {
			$this->error($validate->getError());
		}
	    

	    //存入数据库
	    $data = [
	    	'userName'	=>	$userName,
	    	'email'		=>	$email,
	    	'pwd'		=>	md5($pwd),
	    	'telephone'	=>	$telephone,
	    	'headImg'	=>	$img_path	
	    ];

	    //存入admin表
	    $ret = db('admin')->insert($data);

	    if ($ret != true) {
			$this->error('添加管理员帐号失败！');
		}
		else {
			session('user_id', $userName);
			$this->success('添加管理员帐号成功！','admin/index/index');
		}

    }
}
