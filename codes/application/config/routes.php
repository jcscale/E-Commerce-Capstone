<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'users';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['signup'] = 'users/signup';
$route['signin'] = 'users/signin';
$route['logout'] = 'users/logout';




/////////////////// DASHBOARD ///////////////////
$route['customers'] = 'customers';

$route['dashboards'] = 'dashboards';
$route['products'] = 'dashboards/products';
// $route['index_html'] = 'dashboards/index_html';
// $route['(:any)'] = 'dashboards/loadData/$1';

$route['(:any)'] = 'dashboards/delete_product/$1';
$route['update_product'] = 'dashboards/update_product';
$route['(:any)'] = 'dashboards/show/$1';



/////////////////// CUSTOMER ///////////////////
// $route['customers'] = 'customers';
// $route['customers'] = 'customers';
$route['(:any)'] = 'customers/$1';
// $route['(:any)'] = 'customers/category/$1';
// $route['(:any)/(:any)'] = 'customers/category/$1/$2';
// $route['(:any)'] = 'customers/category/$1/$1';
$route['(:any)'] = 'customers/show/$1';
$route['cart'] = 'customers/cart';
$route['(:any)'] = 'customers/delete_temp_order/$1';
$route['setting'] = 'customers/setting';
$route['order'] = 'customers/order';
// $route['handlePayment']['post'] = "customers/handlePayment";



