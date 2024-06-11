<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Bluerhinos\phpMQTT;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\PermissionController;

//route page
Route::get('/dashboard', function() { return view('admins.dashboard'); });
Route::get('/stat', function() { return view('admins.statistic'); });
Route::get('/type', function() { return view('admins.ticket-type'); });
Route::get('/recipt', function() { return view('admins.recipt'); });
Route::get('/sale', function() { return view('admins.sale-ticket'); });
Route::resource('mqtt', 'Web\MqttController');

// đăng nhập
Route::get('/', 'Web\AuthController@getLogin')->name('get.admin.login');//checked
Route::post('/login', 'Web\AuthController@postLogin')->name('post.admin.login');//checked
Route::get('/tra-cuu-ve/{name}', 'Web\TicKetController@getBill')->name('get.bill');
Route::get('/tai-xuong-pdf/{name}', 'Web\TicKetController@getDownloadBill')->name('download.bill');
Route::get('/kiem-tra-ve/su-dung/{name}', 'Web\TicKetController@checkBill')->name('check.bill');
Route::get('/soat-ve/su-dung/{name}', 'Web\TicKetController@setCheckBill')->name('set.check.bill');
Route::group(['middleware' => 'user'], function() {
    // đăng xuất
    Route::get('/logout', 'Web\AuthController@getLogout')->name('get.admin.logout');
    // tài khoản
    Route::resource('accounts', 'Web\AccountController');
    // loại vé
    Route::resource('ticket-types', 'Web\TicketTypeController');
    // bán vé
    Route::get('/{name}', 'Web\TicKetController@index')->name('get.ticker'); //checking
    Route::resource('ticker', 'Web\TicKetController');
    Route::get('/{name}/check', 'Web\TicKetController@getCheck')->name('get.ticker.check');
    Route::get('/{name}/statistical', 'Web\TicKetController@getStatistical')->name('get.ticker.statistical');
    Route::get('/{name}/stat', 'Web\TicKetController@getStat')->name('get.ticker.stat');
    Route::post('/{name}/stat', 'Web\TicKetController@getStat')->name('get.ticker.stat');
    Route::post('/search', 'Web\TicKetController@search')->name('get.ticker.search');
    //quyen han
    Route::get('/{name}/permission', 'PermissionController@index')->name('get.permission');
    Route::get('/{name}/getpermissionbyroleid', 'PermissionController@getPermissionByRoleId')->name('get.getPermissionByRoleId');
    Route::post('/permission', 'PermissionController@store')->name('post.UpdatePermission');
    Route::post('/createrole', 'PermissionController@create')->name('post.createRoleWithPermission');

    // Route::post('/createpermission', 'PermissionController@createPermission')->name('post.createPermission');
    Route::post('/deleterole', 'PermissionController@destroyRole')->name('post.deleteRole');
    // lấy hóa đơn
    
    //config
    Route::resource('configs','Web\ConfigController');
    //lấy thông tin khách hàng từ mst
    Route::get('/company/tax-code/{tax_code}','Web\CommonController@getCompanyByTaxCode')->name('company.tax.code');
    //Đổi mật khẩu
    Route::post('change-password','Web\AuthController@changePassword')->name('change.password');
});

Route::get('storages/{folder?}/{size?}/{name?}', 'Image\ImageController@getImage')->name('storages.image');

