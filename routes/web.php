<?php
//z正式网站路由开始
//Route::get('index', function () {//主页返回四类广告（大图、小图、文字、急聘广告、最新新闻（5个）），
//    return view('index');
//测试生成session uid
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QSDBController;

Route::any('session', ['uses' => 'PositionController@test1']);
//Route::get('createtable/{tablename}', ['uses' => 'QSDBController@createTable']);

//QSDB
Route::any('/', ['uses' => 'HomeController@index']);//
Route::get('/index', ['uses' => 'HomeController@index']);//
Route::get('/home', ['uses' => 'HomeController@home']);//

//table1管理 -集中器、采集器
Route::get('/db/table1', ['uses' => 'DBTable1Controller@index']);//页面显示
Route::post('/db/table1/checkTableNum', ['uses' => 'HomeController@checkTableNum']);//检查号段是否重复
Route::post('/db/table1/postdata', ['uses' => 'DBTable1Controller@postdata']);//提交数据
//table2管理  户表
Route::get('/db/table2', ['uses' => 'DBTable2Controller@index']);//页面显示
Route::post('/db/table2/postdata', ['uses' => 'DBTable2Controller@postdata']);//提交数据
//table3管理  低压互感器
Route::get('/db/table3', ['uses' => 'DBTable3Controller@index']);//页面显示
Route::post('/db/table3/postdata', ['uses' => 'DBTable3Controller@postdata']);//提交数据
//table4管理  低压互感器
Route::get('/db/table4', ['uses' => 'DBTable4Controller@index']);//页面显示
Route::post('/db/table4/postdata', ['uses' => 'DBTable4Controller@postdata']);//提交数据
//table5管理  低压互感器
Route::get('/db/table5', ['uses' => 'DBTable5Controller@index']);//页面显示
Route::post('/db/table5/postdata', ['uses' => 'DBTable5Controller@postdata']);//提交数据
//table6管理  低压互感器
Route::get('/db/table6', ['uses' => 'DBTable6Controller@index']);//页面显示
Route::post('/db/table6/postdata', ['uses' => 'DBTable6Controller@postdata']);//提交数据
//table7管理  低压互感器
Route::get('/db/table7', ['uses' => 'DBTable7Controller@index']);//页面显示
Route::post('/db/table7/postdata', ['uses' => 'DBTable7Controller@postdata']);//提交数据
//权限管理
Route::get('/db/vender', ['uses' => 'QSDBAdminController@index']);//页面显示
Route::post('/qsdb/admin/add', ['uses' => 'QSDBAdminController@adminAdd']);//添加权限
Route::post('/qsdb/admin/delete', ['uses' => 'QSDBAdminController@adminDelete']);//删除权限

Route::get('/db/homevender', ['uses' => 'QSDBAdminController@homeindex']);//页面显示
Route::post('/qsdb/admin/homeadd', ['uses' => 'QSDBAdminController@adminhomeAdd']);//添加权限
Route::post('/qsdb/admin/homedelete', ['uses' => 'QSDBAdminController@adminhomeDelete']);//删除权限


