<?php
namespace app\common\model;

// use think\Model;
use think\model\Pivot;

class ArticleTagMapModel extends Pivot
{
	protected $pk   = 'id';
	protected $name = 'article_tag_map';
}
