<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('members', 'MemberController');

Route::get('/members/export/{type}', [
    'uses' =>'MemberController@export',
    'as' => 'members.export'
]);