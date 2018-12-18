<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Topic extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function topic()
    {
    	return $this->fetch('topic');
    }
    

    public function getTopicName()
    {
    	$ret = db('topic')->field('name')->select();

    	return $ret;
    }
}
