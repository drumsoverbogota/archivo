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
$route['cambiarpswd'] = 'auth/change_password';
$route['admin'] = 'paginas/admin';
$route['buscar'] = 'paginas/buscar';
$route['bandalanzamiento/asignar_banda'] = 'bandalanzamiento/asignar_banda';
$route['banda/create'] = 'banda/create';
$route['banda/(:any)'] = 'banda/view/$1';
$route['banda'] = 'banda';
$route['todasbanda'] = 'banda/index/true';
$route['lanzamiento/create'] = 'lanzamiento/create';
$route['lanzamiento/(:any)'] = 'lanzamiento/view/$1';
$route['lanzamientos/(:any)'] = 'lanzamiento/index/$1';
$route['lanzamientos/(:any)/(:any)'] = 'lanzamiento/index/$1/$2';
$route['lanzamiento'] = 'lanzamiento';
$route['paginas/send'] = 'paginas/send';
$route['paginas/(:any)'] = 'paginas/view/$1';
$route['paginas'] = 'paginas';
$route['entrada/create'] = 'entrada/create';
$route['entrada/(:any)'] = 'entrada/view/$1';
$route['entrada'] = 'entrada';
$route['publicacion/create'] = 'publicacion/create';
$route['publicacion/(:any)'] = 'publicacion/view/$1';
$route['publicacion'] = 'publicacion';
$route['todaspublicacion'] = 'publicacion/index/true';
$route['default_controller'] = 'paginas';
$route['(:any)'] = 'paginas/view/$1';