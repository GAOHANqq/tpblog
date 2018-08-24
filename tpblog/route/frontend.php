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

Route::get('/ajax/categories$', 'frontend/Article/categoryList')->name('ajax_category_list');
Route::get('/ajax/tags$', 'frontend/Article/tagList')->name('ajax_tag_list');