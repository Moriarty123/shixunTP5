<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Validate;

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

    		//要验证的数据
    		$check = [
    			'phone'	=>	$phone,
    			'pwd'	=>	$pwd
    		];

            //创建验证器
            $validate = new Validate($rule, $msg);

            //返回验证结果
            $res = $validate->check($check);
            
            //输出错误信息
            if ($res != true) {
                $this->error($validate->getError());
            }

            $pwd = md5($pwd);
            //查找用户
    		$res = db('user')	->where("phone = '{$phone}' and pwd = '{$pwd}'")
    							->find();

            if($res == NULL) {
                $this->error('帐号或密码错误！');
            }

            //登录成功
            session('user_id', $phone);

            $this->success('登录成功！','index/index/index');

    		// dump($res);
    	}
    }

    //退出登录
    public function logout() 
    {
        session('user_id', NULL);

        $this->success('退出成功', 'index/index/index');
    }
    
}
