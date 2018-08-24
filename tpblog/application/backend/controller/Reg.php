<?php
namespace app\backend\controller;


use think\Request;
use app\backend\controller\Base;
use app\common\model\UserModel;

class Reg extends Base
{

	public function reg(Request $request)
	{	
		if (session('user')) {
			$this->redirect('homepage');
		}

		if ($request->isPost()) {
			$postData = $request->post();
			//去除空格
			$username = $request->post('username','','trim');

			if (!check_username($username)) {
				$this->error('注册失败,用户名不合法');
			}

			if (!$postData['password']) {
				$this->error('注册失败,密码不能为空');
			}

			if ($postData['password'] != $postData['repassword']) {
				$this->error('注册失败,两次密码不一致');
			}
				//验证用户名是否重复
			$user = new UserModel;
			if ($user->isUserExist($username)) {
				$this->error('注册失败,用户名已存在');
			}

			$user->username = $username;
			$user->password = encrypt($postData['password']);
			$user->nickname = $username;
			$user->save();

			$this->success('注册成功','login');
		}
		return $this->fetch('reg/reg');
	}
		
					// if (!preg_match($pattern, $username)) {
					// 		//不合法的用户名
					// 	$this->error('注册失败,用户名不合法');
					// }

			//验证重复密码是否一致
		

					
					// if (UserModel::where('username',$username)->count()) {
					// 	$this->error('注册失败,用户名已存在');
					// }

					// 	//密码加密存储
					// $password = md5($postData['password']);

		//添加用户
		// $user = new UserModel;
		


	public function userExist (Request $request)
	{
		$username = $request->get('username');
		$user = new UserModel;
		$res = $user->isUserExist($username);

		return json ([
			'status' => 'success',
			'data'   => [
				'exist' => $res,
			]
		]);
	}
}