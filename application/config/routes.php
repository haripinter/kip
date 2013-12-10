<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "frontsite";
$route['404_override'] = '';

$route['shot-(:any)'] = "mod_$1";

$route['home'] = "frontsite";

$route['registrasi'] = "frontsite/registrasi";
$route['aktivasi'] = "frontsite/aktivasi";
$route['aktivasi/baru'] = "frontsite/aktivasi/baru";
$route['download'] = "frontsite/download";
$route['permohonan'] = "frontsite/permohonan";
$route['permohonan/(:any)'] = "frontsite/permohonan/$1";
$route['pengaduan'] = "frontsite/pengaduan";
$route['pengaduan/(:any)'] = "frontsite/pengaduan/$1";
$route['login'] = "frontsite/login";
$route['logout'] = "frontsite/logout";
$route['berita'] = "frontsite/berita";
$route['berita/(:any)/(:any).html'] = "frontsite/berita/$1/$2";
$route['page/(:any)'] = "frontsite/halaman/$1";
$route['(:any).html'] = "frontsite/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */