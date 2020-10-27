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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Home';
$route['404_override'] = 'Error_404/index';
$route['translate_uri_dashes'] = TRUE;
$route["BackPanel"] = "BackPanel/login";
$route["my-account"] = "User/Login";
$route["my-orders"] = "User/MyOrders";
$route["lost-password"] = "User/ForgotPassword";
$route["change-password"] = "User/ChangePassword";
$route["contact-us"] = "Home/ContactUs";
$route["create-password/(:any)"] = "User/ForgotPasswordCheck/$1";
$route["search-product/(:any)"] = "Product/SearchProduct/$1";

$route["product-category/(:any)"]      = "Product/index/$1";
$route["product-category/(:any)/(:any)"]      = "Product/index/$1/$2";
$route["product-category/(:any)/(:any)/(:any)"]      = "Product/index/$1/$2/$3";

$route["shop/(:any)"]      = "Product/Detail/$1";
$route["cart"] = "Cart/index";
$route["checkout"]          = "Cart/checkout";
$route["wishlist"]          = "WishList/wishlist";
$route["payment-success"]   = "Cart/PaymentSuccess";
$route["payment-fail"]      = "Cart/PaymentFail";
$route["(:any)"]            = "Home/CMSDetail/$1";
/*front-page*/
/* $route["get-product-by-category"]["POST"]   = "product/get_product_by_category";
$route["my-product/page/(:any)"]["GET"]     = "product/my_product/$1";
$route["my-product/page"]["GET"]            = "product/my_product";
$route["my-product"]["GET"]                 = "product/my_product";
$route["my-product/edit/(:any)"]["GET"]     = "product/my_product_edit/$1";

/*

$route["Admin"] = "Admin/login"; */

