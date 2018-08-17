<?php

Route::get('/login','backend/Login/login')->name('login');
Route::get('/reg','backend/Reg/reg')->name('reg');

Route::post('/reg/submit','backend/Reg/regSubmit')->name('reg_submit');