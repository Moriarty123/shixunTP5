<?php
namespace app\admin\controller;

use think\Controller;
use think\Validate;

class Common extends Controller
{
    public function index()
    {
        
    	$id = session('admin_id');
    	dump($id);
    	dump("sdsad");
    	if($id == NULL) {
    		$this->error('请登录！', '/admin/login/index');
    	}

    }

}