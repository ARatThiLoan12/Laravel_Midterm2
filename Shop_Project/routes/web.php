<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
// Trang chu
Route::get('index',[
    'as'  => 'trang_chu', 
    'uses' => 'PageController@getIndex'
]);
//Gioi thieu
Route::get('gioi_thieu',[
    'as' => 'about', 
    'uses' => 'PageController@getAbout'
]);
//Lien he
Route::get('lien_he',[
    'as' => 'contact', 
    'uses' => 'PageController@getContact'
]);
//Xem loai san pham
Route::get('loai-san-pham/{type}',[
    'as' => 'loaisanpham',
    'uses' => 'PageController@getLoaiSanPham'
]);
//Xem chi tiet san pham
Route::get('chi-tiet-san-pham/{id}',[
    'as' => 'chitietsanpham',
    'uses' => 'PageController@getChitiet'
]);
// Them vao gio hang
Route::get('add-to-cart/{id}',[
    'as' => 'themgiohang',
    'uses' => 'PageController@getAddToCart'
]);
//Xoa khoi gio hang
Route::get('delete-cart/{id}', [
    'as'=>'xoagiohang', 
    'uses'=>'PageController@getDelItemCart'
]);
//Dat hang
Route::get('dat-hang',[				
    'as' =>'dathang',			
    'uses'=>'PageController@getCheckout'			
]);			
Route::post('dat-hang',[				
    'as'=>'dathang',			
    'uses'=>'PageController@postCheckout'			
]);			
//Dang ki
Route::get('dang-ki',[
    'as'=>'signin',
    'uses'=>'PageController@getSignin'
]);
Route::post('dang-ki',[
    'as'=>'signin',
    'uses'=>'PageController@postSignin'
]);
//admin
Route::get('admin',[
    'as' => 'crud',
    'uses' => 'PageController@getList'
]);
Route::get('admin/insert','PageController@viewInsertProduct');
Route::post('admin/insert', 'PageController@insertProduct');
Route::get('admin/delete/{id}', 'PageController@deleteProduct');
Route::get('admin/edit/{id}', 'PageController@viewEdit');
Route::post('admin/edit/{id}', 'PageController@editProduct');