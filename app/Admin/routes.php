<?php

Route::get('', [
	'as' => 'admin.home',
	function ()
	{
		$content = 'Define your dashboard here.';
		return Admin::view($content, 'Dashboard');
	}
]);

Route::get('locale/switch', [
    'as' => 'locale.switch',
    'uses' => '\App\Http\Controllers\Admin\LocaleController@switchLocale'
]);