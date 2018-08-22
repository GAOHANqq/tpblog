<?php

namespace app\common\model;

use think\Model;

class TagModel extends Model
{
	protected $pk   = 'id';
	protected $name = 'tags';

	public function articles()
    {
        return $this->belongsToMany('ArticleModel', '\\app\\common\\model\\ArticleTagMapModel', 'article_id', 'tag_id');
    }
}