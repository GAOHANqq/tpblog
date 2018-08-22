<?php

Route::rule('/login','backend/Login/login')->name('login');
Route::rule('/logout','backend/Login/logout')->name('logout');
Route::rule('/reg','backend/Reg/reg')->name('reg');

// Route::post('/reg/submit','backend/Reg/regSubmit')->name('reg_submit');
Route::get('/user/exist', 'backend/Reg/userExist')->name('user_exist');

//分类管理
Route::get('/admin/category$', 'backend/Category/index')->name('admin_category_list');
Route::rule('/admin/category/add$', 'backend/Category/add')->name('admin_category_add');
Route::rule('/admin/category/:id/edit$', 'backend/Category/edit')
			->pattern(['id'=>'\d+'])
			->name('admin_category_edit');
Route::rule('/admin/category/:id/delete$', 'backend/Category/delete')
			->pattern(['id'=>'\d+'])
			->name('admin_category_delete');

// 标签管理
Route::get('/admin/tag$', 'backend/Tag/tag')->name('admin_tag_tag');

Route::rule('/admin/tag/add$', 'backend/Tag/add')->name('admin_tag_add');


Route::rule('/admin/tag/:id/edit$', 'backend/Tag/edit')
			->pattern(['id'=>'\d+'])
			->name('admin_tag_edit');
Route::rule('/admin/tag/:id/delete$', 'backend/Tag/delete')
			->pattern(['id'=>'\d+'])
			->name('admin_tag_delete');

//文章管理
Route::get('/admin/article$', 'backend/Article/index')->name('admin_article_list');
Route::rule('/admin/article/add$', 'backend/Article/add')->name('admin_article_add');

Route::rule('/admin/article/:id/edit$', 'backend/Article/edit')
			->pattern(['id'=>'\d+'])
			->name('admin_article_edit');

Route::rule('/admin/article/:id/delete$', 'backend/Article/delete')
			->pattern(['id'=>'\d+'])
			->name('admin_article_delete');

//个人信息
Route::rule('/admin/profile$', 'backend/Profile/index')->name('admin_profile');
Route::post('/admin/avatar/change$', 'backend/Profile/avatarChange')->name('admin_avatar_change');
