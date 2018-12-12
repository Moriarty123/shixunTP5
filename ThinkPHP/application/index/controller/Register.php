<?php
namespace app\index\controller;

use think\Db;
use think\Controller;
use think\Validate;

class Register extends Controller
{
	public function register()
	{
		return $this->fetch();
	}

	public function insert() {
		//使用Input助手函数获取模版传值
		$phone = input('phone', '','htmlspecialchars');
		$captcha = input('captcha', '','htmlspecialchars');
		$pwd = input('pwd', '','htmlspecialchars');
		$repwd = input('repwd', '','htmlspecialchars');

		//定义验证器规则
		$rule = [
			'phone|手机号'	=>	'require|length:11',
			'captcha|验证码'=>	'require|captcha',
			'pwd|密码'		=>	'require|min:6',
			'repwd'			=>	'require|min:6|confirm:pwd'
		];

		//定义验证器报错信息
		$msg = [
			'phone.require'		=>	'手机号不能为空！',
			'phone.length'		=>	'手机号必须为11位',
			'captcha.require'	=>	'验证码不能为空！',
			'captcha.captcha'	=>	'验证码错误！',
			'pwd.require'		=>	'密码不能为空！',
			'pwd.min'			=>	'密码最少为6位',
			'repwd.require'		=>	'请确认密码',
			'repwd.min'			=>	'确认密码最少为6位',
			'repwd.confirm'		=>	'两次密码不一致'
		];

		//要验证的信息
		$check = [
			'phone'	=>	$phone,
			'captcha'	=>	$captcha,
			'pwd'	=>	$pwd,
			'repwd'	=>	$repwd
		];

		//创建验证器
		$validate = new Validate($rule, $msg);

		//返回验证结果
		$res = $validate->check($check);
		
		//输出错误信息
		if ($res != true) {
			$this->error($validate->getError());
		}
		
		$data = [
			'phone' => 	$phone,
			'pwd'	=>	md5($pwd)
		];
		//存入数据库
		$ret = db('user')->insert($data);

		if ($ret != true) {
			$this->error('注册失败！');
		}
		else {
			$this->success('注册成功！');
		}

	}

	public function verity ($data) {
		if ($data['phone'] == '') {
			$this->error('手机号不能为空！');
		}

		if(strlen($data['phone']) != 11) {
			$this->error('手机号为11位');
		}

		if ($data['captcha'] == '') {
			$this->error('验证码不能为空！');
		}

		if (!captcha_check($_POST['captcha'])){
		 	//验证失败
		 	$this->error('验证码错误！');
		};

		if ($data['pwd'] == '') {
			$this->error('密码不能为空！');
		}

		if (strlen($data['pwd']) < 6 || strlen($data['pwd']) > 18) {
			$this->error('密码长度在6到18位之间');
		}

		if ($data['pwd'] != $data['repwd']) {
			$this->error('两次密码不一致');
		}

		return true;
	} 
}
