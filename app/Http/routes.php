<?php

Route::get('/', ['uses' => 'TextLengthController@index']);

Route::any('text-length', ['as' => 'text-length', 'uses' => 'TextLengthController@index']);
Route::any('hash', ['as' => 'hash', 'uses' => 'HashController@index']);
Route::get('client-info', ['as' => 'client-info', 'uses' => 'ClientController@index']);
Route::any('password', ['as' => 'password', 'uses' => 'PasswordController@index']);
Route::any('url-encode', ['as' => 'url-encode', 'uses' => 'UrlEncodeController@index']);
Route::any('ip-blacklist', ['as' => 'ip-blacklist', 'uses' => 'IpBlacklistController@index']);
Route::any('name-generator', ['as' => 'name-generator', 'uses' => 'NameGeneratorController@index']);
Route::any('time-converter', ['as' => 'time-converter', 'uses' => 'TimeConverterController@index']);
Route::any('page-meta', ['as' => 'page-meta', 'uses' => 'PageMetaController@index']);
Route::get('nginx/config/create', ['as' => 'nginx-config.create', 'uses' => 'NginxConfigController@create']);
Route::post('nginx/config', ['as' => 'nginx-config.store', 'uses' => 'NginxConfigController@store']);
Route::any('whois', ['as' => 'whois', 'uses' => 'WhoisController@index']);
