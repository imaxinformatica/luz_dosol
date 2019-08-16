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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

    // Cadastro de usuários
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', 'Admin\UserController@index')->name('index');
        Route::get('/create', 'Admin\UserController@create')->name('create');
        Route::post('/store', 'Admin\UserController@store')->name('store');
        Route::get('/edit/{user}', 'Admin\UserController@edit')->name('edit');
        Route::post('/update/{user}', 'Admin\UserController@update')->name('update');
        Route::get('/status/{user}', 'Admin\UserController@status')->name('status');
        Route::get('/delete/{user}', 'Admin\UserController@delete')->name('delete');
    });

    // Cadastro de usuários
    Route::group(['prefix' => 'produtos', 'as' => 'product.'], function () {
      Route::get('/', 'Admin\ProductController@index')->name('index');
      Route::get('/create', 'Admin\ProductController@create')->name('create');
      Route::post('/store', 'Admin\ProductController@store')->name('store');
      Route::get('/edit/{product}', 'Admin\ProductController@edit')->name('edit');
      Route::post('/update/{product}', 'Admin\ProductController@update')->name('update');
      Route::get('/status/{product}', 'Admin\ProductController@status')->name('status');
      Route::get('/delete/{product}', 'Admin\ProductController@delete')->name('delete');
    });

    // Páginas
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
        Route::get('/', 'Admin\PageController@index')->name('index');
        Route::get('/edit/{page}', 'Admin\PageController@edit')->name('edit');
        Route::post('/update/{page}', 'Admin\PageController@update')->name('update');
    });

    Route::group(['prefix' => 'commission', 'as' => 'commission.'], function () {
        Route::get('/', 'Admin\CommissionController@index')->name('index');
        Route::get('/edit', 'Admin\CommissionController@edit')->name('edit');
        Route::post('/update', 'Admin\CommissionController@update')->name('update');
    });

    Route::group(['prefix' => 'transaction', 'as' => 'transaction.'], function () {
        Route::get('/', 'Admin\TransactionController@index')->name('index');
        Route::get('/edit/{transaction}', 'Admin\TransactionController@edit')->name('edit');
        Route::post('/update/{transaction}', 'Admin\TransactionController@update')->name('update');
    });

    Route::group(['prefix' => 'export', 'as' => 'export.'], function () {
        Route::get('/', 'Admin\ExportController@index')->name('index');
    });

    Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
        Route::get('/', 'Admin\BannerController@index')->name('index');
        Route::get('/create', 'Admin\BannerController@create')->name('create');
        Route::post('/store', 'Admin\BannerController@store')->name('store');
        Route::get('/status/{banner}', 'Admin\BannerController@status')->name('status');
        Route::get('/edit/{banner}', 'Admin\BannerController@edit')->name('edit');
        Route::post('/update', 'Admin\BannerController@update')->name('update');
        Route::get('/delete/{banner}', 'Admin\BannerController@delete')->name('delete');
    });
});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'user'], function () {
    Route::get('/dashboard', 'User\DashboardController@index')->name('dashboard');

    Route::get('/produtos', 'User\ProductController@index')->name('product');

    Route::group(['prefix' => 'carrinho', 'as' => 'cart.'], function(){
        Route::post('/incluir', 'User\CartController@include')->name('include');
        Route::get('/remover/{cart}', 'User\CartController@delete')->name('delete');
    });

    Route::get('/checkout', 'User\CartController@checkout')->name('checkout');

    Route::get('/orders', function () {
        return view('user.pages.orders');
    });

    Route::get('/register', function () {
        return view('user.pages.register');
    });

    Route::get('/financial', function () {
        return view('user.pages.financial');
    });

    Route::get('/network', function () {
        return view('user.pages.network');
    });

    Route::get('/documents', function () {
        return view('user.pages.documents');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'UserAuth\LoginController@login');
    Route::get('/logout', 'UserAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'UserAuth\RegisterController@register');

    Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});
