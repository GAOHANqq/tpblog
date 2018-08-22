<?php

namespace app\backend\controller;

use think\Request;
use app\backend\controller\Base;
use app\common\model\TagModel;

class Tag extends Base
{	
	public function initialize()
	{
		$this->checkSession();	
		$this->assign('nav','tag');	
	}


	public function tag(Request $request)
	{	
 		$currentUser = $this->getCurrentUser();
		$tags = TagModel::where('user_id',$currentUser->id)
										->order('id','desc')
										->select();
		$this->assign('tags',$tags);
		return $this->fetch('tag/tag');
	}
	
	public function add(Request $request)
	{
		if ($request->isPost()) {
			$title = $request->post('title','','trim');
			if (!$title) {
				return $this->error('添加失败,标签不可为空');
			}

			$currentUser = $this->getCurrentUser();
			$tag = new TagModel;
			$tag->name = $title;
			$tag->created_time = time();
			$tag->user_id = $currentUser->id;

			$tag->save();
			return $this->error('成功','admin_tag_tag');
		}
		return $this->fetch('tag/add');
	}

	public function edit(Request $request, $id)
	{
		$tag = TagModel::get($id);
		if (!$tag) {
			return $this->error('编辑失败,标签不存在');
		}
		if ($request->isPost()) {
			$title = $request->post('title', '', 'trim');
			if (!$title) {
				return $this->error('编辑失败,标题不能为空');
			}
			$tag->name = $title;
			$tag->save();
			return $this->success('编辑成功', 'admin_tag_tag');
		}
		$this->assign('tag', $tag);
		return $this->fetch('tag/edit');
	}



	public function delete(Request $request,$id)
		{
			$tag = TagModel::get($id);
			if (!$tag) {
				return $this->error('删除失败,标签不存在');
			}

			$tag->delete();
			return $this->error('删除成功','admin_tag_tag');
		}

}