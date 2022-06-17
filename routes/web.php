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
// ruta de acceso a los invitados 
Route::group(['middleware'=>['guest']],function(){
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
});

// ruta de acceso a los usuarios que estan autenticados
Route::group(['middleware'=>['auth']],function(){
    Route::get('/home', 'HomeController@index');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    
    // Route::get('/main', function(){
    //     return view('contenido/contenido');
    // })->name('main');
    // rutas a donde el comprador puede acceder
    Route::group(['middleware'=>['Comprador']],function(){
        Route:: resource('categoria','CategoriaControllers');
        Route:: resource('producto','ProductoController');
        Route:: resource('proveedor','ProveedorController');
        Route:: resource('compra','CompraController');
    });

    // rutas a donde el vendedor puede acceder
    Route::group(['middleware'=>['Vendedor']],function(){
        Route:: resource('categoria','CategoriaControllers');
        Route:: resource('producto','ProductoController');
        Route:: resource('cliente','ClienteController');
    });

    // rutas a donde el administrador puede acceder
    Route::group(['middleware'=>['Administrador']],function(){
        Route:: resource('categoria','CategoriaControllers');
        Route:: resource('producto','ProductoController');
        Route:: resource('proveedor','ProveedorController');
        Route:: resource('cliente','ClienteController');
        Route:: resource('rol','RolController');
        Route:: resource('usuario','UserController');
        Route:: resource('compra','CompraController');
    });

    

    
});






