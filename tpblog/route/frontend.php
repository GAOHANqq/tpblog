<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('/','frontend/Index/index')->name('homepage');
Route::get('/articles$','frontend/Article/index')->name('article_list');

Route::get('/articles/:id/show$', 'frontend/Article/detail')
		->pattern(['id'=>'\d+'])
		->name('admin_article_detail');
//标签页
Route::get('/tags/:id/articles$', 'frontend/Article/tagArticle')
		->pattern(['id'=>'\d+'])
		->name('tag_article_list');

//用户页
Route::get('/user/:id/articles$', 'frontend/Article/userInfo')
		->pattern(['id'=>'\d+'])
		->name('user_info');


//ajax
Route::get('/ajax/categories$', 'frontend/Article/categoryList')->name('ajax_category_list');
Route::get('/ajax/tags$', 'frontend/Article/tagList')->name('ajax_tag_list');

Route::get('/ajax/hot/articles$', 'frontend/Article/hotArticle')->name('ajax_hot_article');
Route::get('/ajax/articles/:id/relate$', 'frontend/Article/relateArticle')
		->pattern(['id'=>'\d+'])
		->name('ajax_relate_article');

