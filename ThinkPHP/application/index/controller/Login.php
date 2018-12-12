<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
    	if(isset($_POST['submit'])) {
    		//获取登录页面传值
    		$phone = input('phone');
    		$pwd = input('pwd');

    		//定义验证规则
    		$rule = [
    			'phone|手机号'	=>	'require|length:11',
    			'pwd|密码'		=>	'require|min:6'
    		];

    		//定义报错信息
    		$msg = [
    			'phone.require'	=>	'手机号不能为空！',
    			'phone.length'	=>	'手机号必须为11位！',
    			'pwd.require'	=>	'密码不能为空！',
    			'pwd.min'		=>	'密码最少为6位'
    		];

    		



    	}
    }
    
}
