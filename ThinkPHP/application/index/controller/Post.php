<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Post extends Controller
{
    public function index()
    {
        return $this->fetch('postAdd');
    }
}
