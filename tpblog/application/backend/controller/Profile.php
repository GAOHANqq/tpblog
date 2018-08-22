<?php

namespace app\backend\controller;

use think\Request;
use app\backend\controller\Base;

class Profile extends Base
{	
	public function initialize()
	{
		$this->checkSession();	
		$this->assign('nav','profile');		
	}

	public function index(Request $request)
	{
		$currentUser = $this->getCurrentUser();

		if ($request->isPost()) {
			$nickname = $request->post('nickname','','trim');
			if (!$nickname) {
				return $this->error('保存失败,昵称不能为空');
			}

			$currentUser->nickname = $nickname;
			$currentUser->intro = $request->post('intro');
			$currentUser->save();

			return $this->success('保存成功','admin_profile');
		}

		$this->assign('user',$currentUser);
		return $this->fetch('profile/index');
	}

	public function avatarChange(Request $request)
	{
		$file = request()->file('file');

		$uploadDir = './uploads';
		$size = 2 * 1024 * 1024;
		$info = $file->validate(['size'=>$size,'ext'=>'jpg,jpeg,png,gif'])->move($uploadDir);

		if ($info) {

		/*	
			//方法一  框架写法,效果更佳

			// ./uploads/20180822\37b40676cd3fb6962bd56c18495a556c.jpg	
				$filePath = $uploadDir.'/'.$info->getSaveName();
			$image = \think\Image::open($filePath);

			// ./uploads/20180822\37b40676cd3fb6962bd56c18495a556c_thumb.jpg
				$pathinfo = pathinfo($info->getSaveName());
			$thumbSavePath = $pathinfo['dirname'].'/'.$pathinfo['filename'].'_thumb'.$pathinfo['extension'];
			$thumbPath = $uploadDir.'/'.$thumbSavePath;
			$image->thumb(200,200,\think\Image::THUMB_CENTER)->save($thumbPath);

				$currentUser = $this->getCurrentUser();
				$currentUser->avatar = $thumbSavePath;
				$currentUser->save();
		*/










				//方法二  简便写法
			$currentUser = $this->getCurrentUser();
			
			$filePath = str_replace('\\', '/', $info->getSaveName());
			$currentUser->avatar = $filePath;
			$currentUser->save();

			$this->success('上传成功', 'admin_profile');
	    } else {
	        // 上传失败获取错误信息
			return $this->error($file->getError());
	    	}
	}
}