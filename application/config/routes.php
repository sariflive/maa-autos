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

$route['default_controller'] = "welcome";

//Admin Route
$route['admin/sign-in'] = "admin/sign_in";
$route['admin/sign-out'] = "admin/sign_out";
//Admin Route

//front end
$route['news/(:any)'] = "news/index/$1";
$route['blog/(:any)'] = "blog/index/$1";
$route['vehicles/(:any)'] = "vehicles/index/$1";
$route['call-back'] = "call_back";
$route['testimonials/(:any)'] = "testimonials/index/$1";
$route['search/(:any)'] = "search/index/$1";
//front end

$route['404_override'] = '';

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get( 'routes' );
$result = $query->result();
foreach( $result as $row )
{
    $route[ $row->slug ]                 = $row->controller;
    $route[ $row->slug.'/:any' ]         = $row->controller;
    $route[ $row->controller ]           = 'error404';
    $route[ $row->controller.'/:any' ]   = 'error404';
}


/* End of file routes.php */
/* Location: ./application/config/routes.php */