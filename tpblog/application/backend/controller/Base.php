<?php

namespace app\backend\controller;

use think\Controller;
use app\common\model\UserModel;

class Base extends Controller
{
	public function checkSession()
	{
		if (!session('user')) {
			$this->redirect('login');
		}
	}

	public function getCurrentUser()
	{
		$userId = session('user')['id'];
		return UserModel::get($userId);
	}

}