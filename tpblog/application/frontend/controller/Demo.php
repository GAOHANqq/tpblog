<?php
namespace app\frontend\controller;

use think\Request;
use think\Controller;
use app\common\model\UserModel;

class Demo extends Controller{
	public function initialize(){
		$this->assign('nav','demo_list');
	}

public function index(Request $request){
		$where = [];
		$categoryId = $request->get('category',0);
		$category = CategoryModel::get($categoryId);
		if ($category) {
			$where['category_id'] = $category->id;
		}

		$articles  = ArticleModel::where($where)->order('id', 'desc')
										->paginate(3);
		$page = $articles->render();
		$this->assign('page',$page);


		$this->assign('articles',$articles);
		$this->assign('currcategory',$category);
		// $this->assign('currtag',$tag);
		// $this->assign('tags',$tags);
		// $this->assign('categorys',$categorys);

		return $this->fetch('article/list');
	}


    public function detail(Request $request, $id){
		$article = ArticleModel::get($id);
		if (!$article) {
			$this->error('文章不存在', 'homepage');
		}

		//浏览量的获取
		$article->views += 1;
		$article->save();

		$article->user = UserModel::get($article->user_id);

		$article->category = DemoModel::get($article->demo_id);

		$tagIds = ArticleTagMapModel::where('demo_id', $id)->column('tag_id');
		$article->tags = TagModel::whereIn('id', $tagIds)->select();

		$this->assign('article', $article);
        return $this->fetch('demo/detail');
	}

}

>