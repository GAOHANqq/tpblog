<?php
namespace app\frontend\controller;

use think\Request;
use think\Controller;
use app\common\model\UserModel;

class Message extends Controller{

	public function initialize(){
		$this->assign('nav','message_board');		
	}

	public function getCurrentUser(){
		$userId = session('user')['id'];
		return UserModel::get($userId);
	}

	public function index(Request $request){
		

		return $this->fetch('message/list');
	}




	//添加留言
	public function add(Request $request){
		$currentUser = $this->getCurrentUser();

		if ($request->isPost()) {
			$postData = $request->post();
			if (!$postData['message']) {
				return $this->error("添加留言失败");
			}

			$messageModel = new MessageModel;
			$message = $messageModel->addMessage($postData);
			 
			if (!$message) {
				return $this->error('添加留言失败');
			}

			return $this->success('添加留言成功','message_board');
		}


		// 查询留言
		$messsages = TagModel::where('user_id',$currentUser->id)
					->order('id','desc')
					->select();
		$this->assign('message',$messsages);
		return $this->fetch('message/add');
	}
/*
	//ɾ��
	public function delete(Request $request,$id){
			$article = ArticleModel::get($id);
			if (!$article) {
				return $this->error('ɾ��ʧ��,���²�����');
			}

			// ɾ��ǩ
			//�ҳ����еı�ǩ
			// ����һ
			//ArticleTagMapModel::where('article_id',$id)->delete();

			// ����һ ����������detach����
			$article->tags()->detach();

			$article->delete();
			return $this->error('ɾ���ɹ�','admin_article_list');
	}

	*/
}
