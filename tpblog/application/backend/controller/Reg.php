<?php
namespace app\backend\controller;

use think\Controller;
use think\Request;
use app\common\model\UserModel;

class Reg extends Controller
{
	public function reg()
	{
		return $this->fetch('reg\reg');
	}

	public function regSubmit(Request $request)
	{	
		$postData = $request->post();

			//验证用户名是否合法
			//验证用户名是否重复
			//验证重复密码是否一致
			//密码加密存储

		$user = new UserModel;

		$user->username = $postData['username'];
		$user->password = $postData['password'];
		$user->nickname = $postData['username'];
		$user->save();

		print_r($user);

		echo $user->getLastSql();

		print_r($request->post());exit;
	}
}