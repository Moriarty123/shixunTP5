<?php
namespace app\admin\controller;

class Login
{
    public function index()
    {
        return view('login');
    }

    public function login()
    {

    	//如果点击忘记密码
        if(isset($_POST['forget'])) {
        	dump('forget');
        }

        
    	//如果点击登录按钮
        if(isset($_POST['login'])) {
        	dump('login');
        }


    }
}
