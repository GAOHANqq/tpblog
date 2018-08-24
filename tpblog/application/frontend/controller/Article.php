<?php
namespace app\frontend\controller;

use think\Request;
use think\Controller;
use app\common\model\ArticleModel;
use app\common\model\UserModel;
use app\common\model\CategoryModel;
use app\common\model\TagModel;
use app\common\model\ArticleTagMapModel;

class Article extends Controller
{	

	public function index(Request $request)
	{	
		$where = [];

		$categoryId = $request->get('category',0);
		$category = CategoryModel::get($categoryId);
		if ($category) {
			$where['category_id'] = $category->id;
		}

		$articles  = ArticleModel::where($where)->order('id', 'desc')
										->paginate(3);
  //   	$tags      = TagModel::order('id','desc')
  //   									->select();
		 // $categorys = CategoryModel::order('id', 'desc')
										// ->select();

		//分页
		$page = $articles->render();
		$this->assign('page',$page);
		

		$this->assign('articles',$articles);
		$this->assign('currcategory',$category);
		// $this->assign('tags',$tags);
		// $this->assign('categorys',$categorys);

		return $this->fetch('article/list');
	}

	public function detail(Request $request, $id)
	{
		$article = ArticleModel::get($id);
		if (!$article) {
			$this->error('文章不存在', 'homepage');
		}

		// $article->user = UserModel::get($article->user_id);
		// $article->category = CategoryModel::get($article->category_id);

		// $tagIds = ArticleTagMapModel::where('article_id', $id)->column('tag_id');
		// $article->tags = TagModel::whereIn('id', $tagIds)->select();

		$this->assign('article', $article);
        return $this->fetch('article/detail');
	}

	public function categoryList(Request $request)
	{
		$categorys = CategoryModel::where('article_num','>',0)
										->order('id', 'desc')
										->select();

		$this->assign('categorys',$categorys);
		return $this->fetch('article/ajax/category_list');

	}

	public function tagList(Request $request)
	{
		$tags = TagModel::where('article_num','>',0)
										->order('id', 'desc')
										->select();

		$this->assign('tags',$tags);
		return $this->fetch('article/ajax/tag_list');

	}
}