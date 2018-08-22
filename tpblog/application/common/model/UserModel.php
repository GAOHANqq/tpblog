<?php
namespace app\common\model;

use think\Model;

class UserModel extends Model
{
	protected $pk = 'id';
	protected $name = 'users';

	public function isUserExist($username)
	{
		return self::where('username', $username)->count() ? 1 : 0;
	}
} 