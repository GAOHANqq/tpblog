<?php
namespace app\frontend\controller;

use think\Request;
use think\Controller;
use app\common\model\UserModel;

class Demo extends Controller{
	public function initialize(){
		$this->assign('nav','demo_list');
	}



}

>