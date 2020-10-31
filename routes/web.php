<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::get('/home', 'PageController@index');
Route::get('/user/logout', 'Auth\LoginController@userLogout')
											->name('user.logout');


Route::get('/',                                   'PageController@index')                                      ->name('home');

Route::get('/shop',                               'PageController@shop')                                       ->name('shop');
Route::get('/shop/data',                          'PageController@fetch_data')                                 ->name('shop.data');
Route::get('/shop/products',                      'PageController@fetch_data')                                 ->name('fetch.data');

Route::get('/category/{cid}',                     'PageController@category')                                   ->name('category');
Route::get('/category/{cid}/data',                'PageController@category_data');
Route::get('/category/{cid}/products',            'PageController@category_data');

Route::get('/category/{cid}/{sid}',               'PageController@sub_category')                               ->name('sub_category');
Route::get('/category/{cid}/{sid}/{ssid}',        'PageController@sub_sub_category')                           ->name('sub_sub_category');

Route::get('/product/{id}',                       'PageController@product')                                    ->name('specific_product');

Route::get('/about',                              'PageController@about')                                      ->name('about');
Route::get('/orders',                             'PageController@orders')                                     ->name('orders');
Route::get('/contact',                            'PageController@contact')                                    ->name('contact');
Route::post('/contact',                           'PageController@contact_submit')                             ->name('contact.submit');


Route::get('/cart/login/{dt}',                    'CartController@cart_login')                                 ->name('cart.login');


Route::prefix('user')->group(function() {
    
    Route::get('/profile',                        'HomeController@profile')                                    ->name('user.dashboard');
    Route::get('/profile-update',                 'HomeController@profile_update')                             ->name('user.profile.update');
    Route::post('/profile-update',                'HomeController@profile_submit')                             ->name('user.profile.submit');
    Route::get('/orders',                         'HomeController@order')                                      ->name('user.orders');


    Route::get('/cart',                           'CartController@show')                                       ->name('cart');
    Route::post('/cart/store',                    'CartController@store')                                      ->name('cart.store'); //ajax
    Route::post('/cart/add',                      'CartController@addCart')                                    ->name('cart.add');   //normal
    Route::post('/cart/update',                   'CartController@update')                                     ->name('cart.update');
    Route::post('/cart/delete/{pid}',             'CartController@delete')                                     ->name('cart.delete');
    Route::post('/cart-submit',                   'CartController@cart_submit')                                ->name('cart.submit');
    Route::get('/checkout/{did}',                 'CartController@checkout')                                   ->name('cart.checkout');
    Route::post('/order-confirmed',               'CartController@order_submit')                               ->name('order.submit');
    Route::get('/order-confirmed/{oid}',          'CartController@order_placed')                               ->name('order.confirm');
    

    Route::get('/logout',                         'Auth\LoginController@userLogout')                           ->name('user.logout');
});

Route::prefix('admin')->group(function() {

    /* Route::get('/test', 'CategoryController@test'); */
    
    Route::get('/login',                          'Auth\AdminLoginController@showLoginForm')                   ->name('admin.login');
    Route::post('/login',                         'Auth\AdminLoginController@login')                           ->name('admin.login.submit');
    Route::get('/logout',                         'Auth\AdminLoginController@adminLogout')                     ->name('admin.logout');


    Route::post('/password/email',                'Auth\AdminForgotPasswordController@sendResetLinkEmail')     ->name('admin.password.email');
    Route::get('/password/reset',                 'Auth\AdminForgotPasswordController@showLinkRequestForm')    ->name('admin.password.request');
    Route::post('/password/reset',                'Auth\AdminResetPasswordController@reset')                   ->name('admin.password.update');
    Route::get('/password/reset/{token}',         'Auth\AdminResetPasswordController@showResetForm')           ->name('admin.password.reset');


    Route::get('/profile',                        'AdminController@profile')                                    ->name('admin.profile');
    Route::get('/profile-update',                 'AdminController@profile_update')                             ->name('admin.profile.update');
    Route::post('/profile-update',                'AdminController@profile_submit')                             ->name('admin.profile.submit');


    Route::get('/',                               'AdminController@index')                                     ->name('admin.dashboard');
    Route::get('/dashboard',                      'AdminController@index')                                     ->name('admin.dashboard');
    Route::get('/dashboard/data',                 'AdminController@fetch_data');



    Route::get('/orders',                         'AdminController@orders')                                    ->name('admin.orders');
    Route::get('/orders/{property}',              'AdminController@propertised_orders')                        ->name('admin.properties.orders');
    Route::get('/order/{id}',                     'AdminController@order_specific')                            ->name('admin.order.details');
    Route::post('/order/status',                  'AdminController@order_status')                              ->name('admin.order.status');
    


    Route::get('/products',                       'ProductController@products')                                ->name('admin.products');
    Route::get('/product/{id}',                   'ProductController@product_specific')                        ->name('admin.product.specific');
    Route::get('/products/add',                   'ProductController@product_add')                             ->name('admin.product.add');
    Route::post('/products/add',                  'ProductController@products_add_submit')                     ->name('admin.product.submit');
    Route::get('/product/{id}/edit',              'ProductController@product_edit')                            ->name('admin.product.edit');
    Route::post('/product/{id}/edit',             'ProductController@product_edit_submit')                     ->name('admin.product.edit.submit');
    Route::post('/product/status',                'ProductController@product_status')                          ->name('admin.product.status');
    Route::post('/product/delete',                'ProductController@product_delete_submit')                   ->name('admin.delete.submit');
    
    

    Route::get('/categories',                     'CategoryController@categories')                             ->name('admin.categories');
    Route::post('/category/add',                  'CategoryController@category_fetch')                         ->name('admin.subcategory.fetch');
    Route::get('/category/{type}',                'CategoryController@category_add')                           ->name('admin.category.add');
    Route::post('/category/submit',               'CategoryController@category_submit')                        ->name('admin.category.submit');
    Route::get('/category/{id}/edit',             'CategoryController@category_edit')                          ->name('admin.category.edit');
    Route::post('/category/{id}/edit',            'CategoryController@category_edit_submit')                   ->name('admin.category.edit.submit');
    Route::post('/category/delete',               'CategoryController@category_delete')                        ->name('admin.category.delete');
    Route::get('/category/{id}/update/{value}',   'CategoryController@category_update')                        ->name('admin.category.update');


    Route::get('/top',                            'ProductController@top')                                     ->name('admin.top');
    Route::get('/top/add/{type}',                 'ProductController@top_add')                                 ->name('admin.top.add');
    Route::get('/top/add/{type}/{pid}',           'ProductController@top_add_submit')                          ->name('admin.top.add.submit');
    Route::get('/top/remove/{type}',              'ProductController@top_remove')                              ->name('admin.top.remove');
    Route::get('/top/remove/{type}/{pid}',        'ProductController@top_remove_submit')                       ->name('admin.top.remove.submit');

    
});

















