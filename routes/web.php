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
        Route::post('/senha', 'Admin\UserController@password')->name('password');
        Route::post('/attach', 'Admin\UserController@attach')->name('attach');
        Route::post('/update/{user}', 'Admin\UserController@update')->name('update');
        Route::get('/status/{user}', 'Admin\UserController@status')->name('status');
        Route::get('/delete/{user}', 'Admin\UserController@delete')->name('delete');
    });
    // Graduados
    Route::group(['prefix' => 'graduados', 'as' => 'graduated.'], function () {
        Route::get('/', 'Admin\GraduatedController@index')->name('index');
    });

    // Cadastro de categoriass
    Route::group(['prefix' => 'categorias', 'as' => 'category.'], function () {
        Route::get('/', 'Admin\CategoryController@index')->name('index');
        Route::get('/create', 'Admin\CategoryController@create')->name('create');
        Route::post('/store', 'Admin\CategoryController@store')->name('store');
        Route::get('/edit/{category}', 'Admin\CategoryController@edit')->name('edit');
        Route::post('/update/{category}', 'Admin\CategoryController@update')->name('update');
        Route::get('/delete/{category}', 'Admin\CategoryController@delete')->name('delete');
    });

    // Cadastro de produtos
    Route::group(['prefix' => 'produtos', 'as' => 'product.'], function () {
        Route::get('/', 'Admin\ProductController@index')->name('index');
        Route::get('/create', 'Admin\ProductController@create')->name('create');
        Route::post('/store', 'Admin\ProductController@store')->name('store');
        Route::get('/edit/{product}', 'Admin\ProductController@edit')->name('edit');
        Route::post('/update/{product}', 'Admin\ProductController@update')->name('update');
        Route::get('/status/{product}', 'Admin\ProductController@status')->name('status');
        Route::get('/delete/{product}', 'Admin\ProductController@delete')->name('delete');
    });

    // Cadastro de premios
    Route::group(['prefix' => 'premios', 'as' => 'premium.'], function () {
        Route::get('/', 'Admin\PremiumController@index')->name('index');
        Route::get('/create', 'Admin\PremiumController@create')->name('create');
        Route::post('/store', 'Admin\PremiumController@store')->name('store');
        Route::get('/edit/{premium}', 'Admin\PremiumController@edit')->name('edit');
        Route::post('/update', 'Admin\PremiumController@update')->name('update');
        Route::get('/delete/{premium}', 'Admin\PremiumController@delete')->name('delete');
    });

    // Bancos
    Route::group(['prefix' => 'banco', 'as' => 'bank.'], function () {
        Route::get('/', 'Admin\BankController@index')->name('index');
        Route::post('/store', 'Admin\BankController@store')->name('store');
        Route::post('/update/', 'Admin\BankController@update')->name('update');
        Route::get('/delete/{bank}', 'Admin\BankController@delete')->name('delete');
    });

    // Páginas
    Route::group(['prefix' => 'pages', 'as' => 'pages.'], function () {
        Route::get('/', 'Admin\PageController@index')->name('index');
        Route::get('/edit/{page}', 'Admin\PageController@edit')->name('edit');
        Route::post('/update/{page}', 'Admin\PageController@update')->name('update');
    });
    // Frete particular
    Route::group(['prefix' => 'particular', 'as' => 'particular.'], function () {
        Route::get('/', 'Admin\ParticularController@index')->name('index');
        Route::get('create', 'Admin\ParticularController@create')->name('create');
        Route::post('store', 'Admin\ParticularController@store')->name('store');
        Route::get('edit/{particular}', 'Admin\ParticularController@edit')->name('edit');
        Route::post('/update{particular}', 'Admin\ParticularController@update')->name('update');
        Route::get('/delete/{particular}', 'Admin\ParticularController@delete')->name('delete');
    });

    Route::group(['prefix' => 'commission', 'as' => 'commission.'], function () {
        Route::get('/', 'Admin\CommissionController@index')->name('index');
        Route::get('/edit', 'Admin\CommissionController@edit')->name('edit');
        Route::post('/update', 'Admin\CommissionController@update')->name('update');
    });

    Route::group(['prefix' => 'documento', 'as' => 'document.'], function () {
        Route::get('/', 'Admin\DocumentController@index')->name('index');
        Route::get('/create', 'Admin\DocumentController@create')->name('create');
        Route::post('/store', 'Admin\DocumentController@store')->name('store');
        Route::get('/edit/{document}', 'Admin\DocumentController@edit')->name('edit');
        Route::post('/update/{document}', 'Admin\DocumentController@update')->name('update');
        Route::get('/delete/{document}', 'Admin\DocumentController@delete')->name('delete');
    });

    Route::group(['prefix' => 'pedido', 'as' => 'order.'], function () {
        Route::get('/', 'Admin\OrderController@index')->name('index');
        Route::get('/show/{order}', 'Admin\OrderController@show')->name('show');
    });

    Route::group(['prefix' => 'export', 'as' => 'export.'], function () {
        Route::get('/', 'Admin\ExportController@index')->name('index');
        Route::post('/gerar', 'Admin\ExportController@generate')->name('generate');
        Route::post('/transfeera', 'Admin\ExportController@transfeera')->name('transfeera');
    });
    Route::group(['prefix' => 'configuracao', 'as' => 'configuration.'], function () {
        Route::get('/', 'Admin\ConfigurationController@index')->name('index');
        Route::post('/update', 'Admin\ConfigurationController@update')->name('update');
        Route::post('/cycle', 'Admin\ConfigurationController@cycle')->name('cycle');
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

    Route::group(['prefix' => 'carrinho', 'as' => 'cart.'], function () {
        Route::get('/', 'User\CartController@cart')->name('index');
        Route::post('/incluir', 'User\CartController@include')->name('include');
        Route::post('/update/{product}', 'User\CartController@update')->name('update');
        Route::get('/remover/{cart}', 'User\CartController@delete')->name('delete');
    });

    // Cadastro de usuários
    Route::group(['prefix' => 'usuario', 'as' => 'user.'], function () {
        Route::get('/rede', 'User\UserController@index')->name('index');
        Route::get('/create', 'User\UserController@create')->name('create');
        Route::post('/store', 'User\UserController@store')->name('store');
    });

    
    Route::group(['prefix' => 'configuracao', 'as' => 'configuration.'], function () {
        Route::get('/', 'User\ConfigurationController@index')->name('index');
        Route::post('avatar', 'User\ConfigurationController@changeAvatar')->name('avatar');
        Route::post('/update', 'User\ConfigurationController@update')->name('update');
    });
    Route::group(['prefix' => 'dados-bancarios', 'as' => 'financial.'], function () {
        Route::get('/', 'User\FinancialController@edit')->name('edit');
        Route::post('/update', 'User\FinancialController@update')->name('update');
    });

    Route::group(['prefix' => 'documento', 'as' => 'document.'], function () {
        Route::get('/', 'User\DocumentController@index')->name('index');
    });

    Route::group(['prefix' => 'pedido', 'as' => 'order.'], function () {
        Route::get('/', 'User\OrderController@index')->name('index');
        Route::get('/visualizar/{order}', 'User\OrderController@show')->name('show');
        Route::post('/checkout', 'User\OrderController@checkout')->name('checkout');
    });


    Route::get('/documents', function () {
        return view('user.pages.documents');
    });
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'UserAuth\LoginController@login');
    Route::get('/logout', 'UserAuth\LoginController@logout')->name('logout');

    // Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
    Route::get('/cadastro/{user}', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/session/cadastro', 'User\RegisterController@sessionRegister')->name('register.session');
    Route::get('/finalizar/cadastro', 'User\RegisterController@register')->name('register.finish');
    Route::post('/register', 'UserAuth\RegisterController@register');

    Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('user.password.reset');
    Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'AdminAuth\RegisterController@register');

    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.request');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Route::post('session-pagseguro', 'User\OrderController@getSession')->name('session.pagseguro');
Route::get('get-bonus', 'User\DashboardController@getBonus')->name('get-bonus');

Route::get('/card-content', function(){
    return view('user.parts.card');
})->name('card.content');
Route::get('/address-content', function(){
    return view('user.parts.address');
})->name('address.content');
Route::post('/callback-pagseguro', 'User\OrderController@callback')->name('callback.pagseguro');


Route::get('/get-shipping', 'User\OrderController@getShipping')->name('get.shipping');

Route::get('/verificar-graduacao', function () {
    $sv = new App\Services\ServiceGraduation;
    $sv->getMaxGraduation();
});

Route::get('/reiniciar-mes', function(){
    App\Services\ServiceUser::resetMonth();
});
Route::get('/criar-bonus', function () {
    App\Services\ServiceOrder::createBonus();
});

Route::get('atualiza',function(){
    alteraMedidas();
});