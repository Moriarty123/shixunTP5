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
    		$this->error('请登录！', '/admin/login/index');
    	}
    }

}