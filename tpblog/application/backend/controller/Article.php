<?php

namespace app\backend\controller;

use think\Request;
use app\backend\controller\Base;
use app\common\model\ArticleModel;
use app\common\model\CategoryModel;
use app\common\model\TagModel;
use app\common\model\ArticleTagMapModel;

class Article extends Base
{	
	public function initialize()
	{
		$this->checkSession();	
		$this->assign('nav','article');	
	}


	public function index(Request $request)
	{	
 		$currentUser = $this->getCurrentUser();
		$articles = ArticleModel::where('user_id',$currentUser->id)
										->order('id','desc')
										->paginate(3);//分页
		
	    $page = $articles->render();

		//通过循环 
		//方法一
		// foreach ($articles as $key => $article) {
		// 	$category = CategoryModel::get($article->category_id );
		// 	$article->category = $category;
		// }


		//方法二
		// $categoryIds = [];
		// foreach ($articles as $key => $article) {
		// 	$categoryIds[] = $article->category_id;
		// }
		// $$categories = CategoryModel::where('id',$categoryIds)
		// 								->select()
		// 								->toArray();

		// $newCategories = [];
		// foreach ($categories as $key => $$category) {
		// 	$newCategories[$category->id] = $category;
		// }

		//方法三  hasOne()方法,详见Articlemodel


		$this->assign('articles',$articles);
		$this->assign('page',$page);
		// $this->assign('newCategories',$newCategories);
		return $this->fetch('article/list');
	}
	
	//添加
	public function add(Request $request)
	{
		$currentUser = $this->getCurrentUser();

		if ($request->isPost()) {
			$postData = $request->post();
			if (!$postData['title']) {
				return $this->error('添加失败,标题不可为空');
			}
			if (!$postData['content']) {
				return $this->error('添加失败,内容不可为空');
			}

			$articleModel = new ArticleModel;
			$article = $articleModel->addArticle($postData);
			  // var_dump($article);exit;
			if (!$article) {
				return $this->error('添加失败');
			}

			return $this->success('添加成功','admin_article_list');
		}


		//查出所有的category和tag
		$categories = CategoryModel::where('user_id',$currentUser->id)
					->order('id','desc')
					->select();
		$tags = TagModel::where('user_id',$currentUser->id)
					->order('id','desc')
					->select();
		$this->assign('categories',$categories);
		$this->assign('tags',$tags);

		return $this->fetch('article/add');
	}

	//编辑
	public function edit(Request $request, $id)
	{
		$currentUser = $this->getCurrentUser();
		$article = ArticleModel::get($id);
		if (!$article) {
			return $this->error('编辑失败,文章不存在');
		}
		if ($request->isPost()) {
			$postData = $request->post();
			if (!$postData['title']) {
				return $this->error('编辑失败,标题不能为空');
			}
			if (!$postData['content']) {
				return $this->error('编辑失败,内容不能为空');
			}

			$articleModel = new ArticleModel;
			$article = $articleModel->editArticle($id, $postData);

			if (!$article) {
				return $this->error('编辑失败');
			}
			return $this->success('编辑成功', 'admin_article_list');
		}

		$article->tagIds = ArticleTagMapModel::where('article_id', $id)->column('tag_id');
		// 查出所有的category和tag
		$categories = CategoryModel::where('user_id', $currentUser->id)
						->order('id', 'desc')
						->select();
		$tags = TagModel::where('user_id', $currentUser->id)
						->order('id', 'desc')
						->select();
		$this->assign('categories', $categories);
		$this->assign('tags', $tags);
		$this->assign('article', $article);

		return $this->fetch('article/edit');
	}

	//删除
	public function delete(Request $request,$id)
		{
			$article = ArticleModel::get($id);
			if (!$article) {
				return $this->error('删除失败,文章不存在');
			}

			// 删标签
			//找出所有的标签
			// 方法一
			//ArticleTagMapModel::where('article_id',$id)->delete();

			// 方法一 多表关联后用detach方法
			$article->tags()->detach();

			$article->delete();
			return $this->error('删除成功','admin_article_list');
		}

	
}

