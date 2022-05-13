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

//Route::get('/', 'HomeController@index');

Route::get('/dashboard', 'dashboard\DashboardController@index')->middleware('admin');
Route::get('/dashboard_cliente', 'dashboard\DashboardController@cliente');
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

/**
 * Rutas rol Administrador
 */
Route::group(['middleware' => 'admin'], function() {
    Route::resources(['products' => dashboard\ProductController::class]);
    Route::resources(['categories' => dashboard\CategoryController::class]);
    Route::get('/customers', 'dashboard\CustomerController@index')->name('customers');
    Route::resources(['orders' => dashboard\OrderController::class]);
    Route::post('order-new', 'dashboard\OrderController@new')->name('order-new');
});


/**
 * Rutas rol Cliente
 */
Route::get('/mis_pedidos', 'dashboard_customer\OrderController@index')->name('mis_pedidos');
Route::get('/pedido/{id}', 'dashboard_customer\OrderController@show')->name('pedido');
Route::get('/vacios', 'dashboard_customer\DashboardController@vacios')->name('vacios');
Route::get('/pagos', 'dashboard_customer\DashboardController@payment_history')->name('pagos');





Route::get('/home', 'HomeController@index')->name('home');

