<?php
namespace app\common\model;

use think\Model;
use think\Db;

use app\common\model\ArticleTagMapModel;
use app\common\model\UserModel;

class MessageModel extends Model
{
	protected $pk   = 'id';
	protected $name = 'messages';

	//一对一关联
	public function articles(){
		return $this->hasOne('CategoryModel','id','article_id');
	}
    public function message(){
		return $this->hasOne('MessageModel','id','user_id');
	}

	public function user(){
		return $this->hasOne('UserModel','id','user_id');
	}

	//多对多关联
	 public function tags(){
        return $this->belongsToMany('TagModel','\\app\\common\\model\\ArticleTagMapModel','tag_id','article_id');
    }

	public function getCurrentUser(){
		$userId = session('user')['id'];
		return UserModel::get($userId);
	}

	public function addMessage($postData){
		$currentUser = $this->getCurrentUser();

		Db::startTrans();

		try {
			$message = new self;
			$message->message = $postData['message'];
			$message->created_time = time();
			$message->updated_time = time();
			$message->user_id = $currentUser->id;
			$article->save();

			if (isset($postData['message']) && !empty($postData['message'])) {
				// 方法一
				// $articleTag = new ArticleTagMapModel;
				// $tags = [];
				// foreach ($postData['tag'] as $tagId) {
				// 	$tags[] = ['article_id'=>$article->id, 'tag_id'=>$tagId];
				// }

				// $articleTag->saveAll($tags);
				//方法二
				$article->message()->saveAll($postData['message']);
			}
			//提交事务
			Db::commit();

			return $message;
		} catch (\Exception $e) {
			//回滚事务
			Db::rollback();
			return false;
		}
	}

    
    public function updateCategoryArticleNum(){
    	$currentUser = $this->getCurrentUser();
    	$message = CategoryModel::where('user_id',$currentUser->id)->select();
    	if (!$message) {
    		return true;
    	}
    }

}
