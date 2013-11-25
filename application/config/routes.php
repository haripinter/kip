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

$route['default_controller'] = "Frontsite";
$route['404_override'] = '';

$route['admin'] = "Admin";
$route['shot-(:any)'] = "mod_$1";

$route['home.html'] = "Frontsite";

$route['registrasi'] = "Frontsite/registrasi";
$route['aktivasi'] = "Frontsite/aktivasi";
$route['aktivasi/baru'] = "Frontsite/aktivasi/baru";
$route['download'] = "Frontsite/download";
$route['permohonan'] = "Frontsite/permohonan";
$route['permohonan/(:any)'] = "Frontsite/permohonan/$1";
$route['pengaduan'] = "Frontsite/pengaduan";
$route['pengaduan/(:any)'] = "Frontsite/pengaduan/$1";

$route['berita/(:any)/(:any).html'] = "Frontsite/berita/$1/$2";
$route['page/(:any)'] = "Frontsite/halaman/$1";
$route['(:any).html'] = "Frontsite/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */