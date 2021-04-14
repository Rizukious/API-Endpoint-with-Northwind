<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use Illuminate\Http\Request;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// membuat Route dengan nama Hello
// $router->get("/hello", function() {
// 	return "<h1 style='color:green;'>Hello, Selamat belajar Lumen dari Laravel</h1>";
// });

// Membuat route dengan parameter
// $router->get("/hello/{nama}", function($nama) {
// 	return "<h1 style='color:green;'>Hello $nama, Selamat belajar Lumen dari Laravel</h1>";
// });

// Membuat route dengan parameter dan query string
// 1. menambahkan request illuminate di paling atas
// $router->get("/hello[/{nama}]", function(Request $request, $nama = 'Joni') {
// 	$jurusan = $request->get("jurusan");
// 	return "<h1 style='color:green;'>Hello $nama, Jurusan = $jurusan <br>Selamat belajar Lumen dari Laravel</h1>";
// });

// Membuat Route dengan Regex
// $router->get("/hello[/{nama:[a-zA-Z0-9]+}]", function(Request $request, $nama = 'Joni') {
// 	return "<h1 style='color:green;'>Hello $nama, Selamat belajar Lumen dari Laravel</h1>";
// });

// Membuat Route dengan memberikan namanya
$router->get("/hello/{nama:[a-zA-Z0-9]+}", [
	'as' => 'he', function($nama = 'Joni') {
	return "<h1 style='color:green;'>Hello $nama</h1>";
}
]);

// Membuat route dengan fungsi redirect
$router->get("/alias", function() {
	return redirect()->route("he", ['nama' => 'Agus']);
});

// Membuat router untuk memanggil route yang diberikan nama dengan fungsi route
$router->get('/routeinfo', function() {
	$url = route("he");
	return "url hello = $url";
});

// Membuat Router Group dengan Prefix
// menggunakan user router
$router->group(['prefix' => 'user', 'middleware'=>'auth'], function() use ($router) {
	// Membuat Routing ke Controller UserController dengan function getAll data User
	$router->get("/", 'UserController@getAll');

	// dengan Method Get
	$router->get("/{id}", 'UserController@getById');

	// dengan Method Post
	// dimasukkan Method Request
	$router->post('/', 'UserController@insert');

	// dengan Method Put
	$router->put('/{id}', 'UserController@update');

	// dengan Method Delete
	$router->delete('/{id}', 'UserController@delete');	
});

// membuat endpoint Customers
$router->group(['prefix' => 'api/v1/customers'], function() use ($router) {
	$router->get('/', 'CustomersController@get');
	$router->get('/{id}', 'CustomersController@getById');
	$router->post('/', 'CustomersController@insert');
	$router->put('/{id}', 'CustomersController@update');
	$router->delete('/{id}', 'CustomersController@delete');
});

// membuat endpoint Employees
$router->group(['prefix' => 'api/v1/employees'], function() use ($router) {
	$router->get('/', 'EmployeesController@get');
	$router->get('/{id}', 'EmployeesController@getById');
	$router->post('/', 'EmployeesController@insert');
	$router->put('/{id}', 'EmployeesController@update');
	$router->delete('/{id}', 'EmployeesController@delete');
});

// membuat endpoint Products
$router->group(['prefix' => 'api/v1/products'], function() use ($router) {
	$router->get('/', 'ProductsController@get');
	$router->get('/{id}', 'ProductsController@getById');
	$router->post('/', 'ProductsController@insert');
	$router->put('/{id}', 'ProductsController@update');
	$router->delete('/{id}', 'ProductsController@delete');
});

// membuat endpoint Categories
$router->group(['prefix' => 'api/v1/categories'], function() use ($router) {
	$router->get('/', 'CategoriesController@get');
	$router->get('/{id}', 'CategoriesController@getById');
	$router->post('/', 'CategoriesController@insert');
	$router->put('/{id}', 'CategoriesController@update');
	$router->delete('/{id}', 'CategoriesController@delete');
});

// membuat endpoint Suppliers
$router->group(['prefix' => 'api/v1/suppliers'], function() use ($router) {
	$router->get('/', 'SuppliersController@get');
	$router->get('/{id}', 'SuppliersController@getById');
	$router->post('/', 'SuppliersController@insert');
	$router->put('/{id}', 'SuppliersController@update');
	$router->delete('/{id}', 'SuppliersController@delete');
});

// membuat endpoint Orders
$router->group(['prefix' => 'api/v1/orders'], function() use ($router) {
	$router->get('/', 'OrdersController@get');
	$router->get('/{id}', 'OrdersController@getById');
	$router->post('/', 'OrdersController@insert');
	$router->put('/{id}', 'OrdersController@update');
	$router->delete('/{id}', 'OrdersController@delete');
});


