<?php
namespace app\admin\controller;

use think\Controller;

use app\admin\controller\Common;

class login extends Controller
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
        	// dump('login');

            //1 获取登录帐号和密码
            $email = input('post.email');
            $pwd = input('post.pwd');

            //2 验证数据
            

            //3 判断是否已注册
            $pwd = md5($pwd);
            $where = "email='{$email}' and pwd = '{$pwd}'";

            $account = db('admin')  ->where($where)
                                    ->find();

            // dump($account);
            if($account == NULL) {
                $this->error('邮箱或密码错误！');
            }
            // dump($account);
            

            //4 后序工作
            session('admin_id', $account['id']);
            session('admin_name', $account['userName']);
            session('admin_head_img', $account['headImg']);
            session('loginTime', time());
            
            $this->success('登录成功！', '/admin/index/index');

        }
    }

    //退出登录
    public function logout() 
    {
        session('admin_id', NULL);
        session('admin_name', NULL);
        session('admin_head_img', NULL);

        $this->success('退出成功', 'admin/index/index');
    }

    
}
