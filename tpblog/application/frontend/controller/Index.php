<?php
namespace app\frontend\controller;

use think\Request;
use think\Controller;
use app\common\model\ArticleModel;
use app\common\model\UserModel;
use app\common\model\CategoryModel;
use app\common\model\TagModel;
use app\common\model\ArticleTagMapModel;

class Index extends Controller
{
    public function index(Request $request)
    {	
    	$articles = ArticleModel::order('id','desc')->limit(3)->select();


    	// $tags = TagModel::order('id','desc')->select();
    	// $categorys = CategoryModel::where('article_num','>',0)->order('id', 'desc')->select();


    	$this->assign('articles',$articles);
    	// $this->assign('tags',$tags);
    	// $this->assign('categorys',$categorys);
        return $this->fetch('index/homepage');
    }
}
