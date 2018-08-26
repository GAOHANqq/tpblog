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
    	// $tags      = TagModel::order('id','desc')
    	// 								->select();
		 // $categorys = CategoryModel::order('id', 'desc')
										// ->select();
		//Model中设置了一对一,多对一对应关系

		//分页
		$page = $articles->render();
		$this->assign('page',$page);
		

		$this->assign('articles',$articles);
		$this->assign('currcategory',$category);
		// $this->assign('currtag',$tag);
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

		//浏览量的获取
		$article->views += 1;
		$article->save();

		// $article->user = UserModel::get($article->user_id);
		// $article->category = CategoryModel::get($article->category_id);

		// $tagIds = ArticleTagMapModel::where('article_id', $id)->column('tag_id');
		// $article->tags = TagModel::whereIn('id', $tagIds)->select();

		$this->assign('article', $article);
        return $this->fetch('article/detail');
	}

	public function tagArticle(Request $request,$id)
	{	
		$tag = TagModel::get($id);
		if (!$tag) {
			$this->error('标签不存在', 'homepage');
		}

		$articleIds = ArticleTagMapModel::where('tag_id', $id)->column('article_id');
		$articles  = ArticleModel::whereIn('id',$articleIds)->order('id', 'desc')->paginate(3);

		$page = $articles->render();
		
		$this->assign('articles',$articles);
		$this->assign('tag',$tag);
		$this->assign('page',$page);



		return $this->fetch('article/tag_article_list');

	}

	public function userInfo(Request $request,$id)
	{
		$user= UserModel::get($id);
		if (!$user) {
			return $this->error('用户不存在','homepage');
		}

		$articles  = ArticleModel::where('user_id',$user->id)->order('id', 'desc')->paginate(3);

		$page = $articles->render();
		$this->assign('page',$page);


		$this->assign('user',$user);	
		$this->assign('articles',$articles);	

		return $this->fetch('user_info');


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
		$tags = TagModel::order('id', 'desc')
										->select();

		$this->assign('tags',$tags);
		return $this->fetch('article/ajax/tag_list');

	}

	//热门文章
	public function hotArticle(Request $request)
	{
		$hotArticles  = ArticleModel::order('views', 'desc')->limit(5)->select();

		$this->assign('hotArticles',$hotArticles);	

		return $this->fetch('article/ajax/hot_article');	
	}

	public function relateArticle(Request $request,$id)
	{
		$article = ArticleModel::get($id);
		if (!$article) {
			return '文章不存在';
		}
				// 找到当前文章的tags
		$tagIds = ArticleTagMapModel::where('article_id',$id)->column('tag_id');
		// select * from blog_articles a left join blog_article_tag_map b on a.id=b.article_id where b.tag_id in (11, 10 ,8) group by a.id
		// 去找包含这些tags中一个或多个的文章
		$articles = ArticleTagMapModel::whereIn('tag_id', $tagIds)->column('article_id');
		$relateArticles = ArticleModel::whereIn('id', $articles)->limit(5)->select();
		$this->assign('relateArticles',$relateArticles);	

		return $this->fetch('article/ajax/relate_article');
	}
}