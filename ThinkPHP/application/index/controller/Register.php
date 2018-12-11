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

		$validate = new Validate([
			'psd|密码'  => 'require|min:6',
			'repsd|密码'  => 'require|min:6',
			'captcha|验证码'=>'require|captcha'
		]);

		// dump($_POST);
		// $data = $_POST['code'];
		$data['captcha'] = $_POST['captcha'];
		$data['psd'] = $_POST['psd'];
		$data['repsd'] = $_POST['repsd'];

		// dump($data);
		$res = $validate->check($data);

		

		if ($res == true) {
			echo '输入成功';
		}

	}

	public function verity () {

	} 
}
