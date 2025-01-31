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
$route['default_controller'] = 'auth_panel/login';
$route['library-home'] = '';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*routing for admin panel start */
$route['admin-panel'] = 'auth_panel/login';
$route['admin-panel/dashboard'] = 'auth_panel/admin/index';
$route['admin-panel/otp-authentication'] = 'auth_panel/admin/otp_authentication';
$route['admin-panel/add-backend-user'] = 'auth_panel/admin/create_backend_user';
$route['admin-panel/backend-user-list'] = 'auth_panel/admin/backend_user_list';
$route['admin-panel/device-list'] = 'auth_panel/device_management/device_management/device_list';
$route['admin-panel/employee-list'] = 'auth_panel/employee_management/employee_management/employee_list'; 
$route['admin-panel/attendance-report'] = 'auth_panel/employee_management/attendance_report/attendance_report';
$route['admin-panel/employee-attendance-record/(:any)'] = 'auth_panel/employee_management/attendance_report/employee_attendance_record/$1';
$route['admin-panel/visitor-list'] = 'auth_panel/visitor_management/visitor_management/visitor_list';
$route['admin-panel/visitor-details/(:num)'] = 'auth_panel/visitor_management/visitor_management/visitor_details/$1';
$route['admin-panel/pass-list'] = 'auth_panel/pass_management/pass_management/pass_list';
$route['admin-panel/pass-details/(:num)'] = 'auth_panel/pass_management/pass_management/pass_details/$1';
$route['admin-panel/role-management'] = 'auth_panel/admin/make_permission_group';
$route['admin-panel/version-control'] = 'auth_panel/version_control/version/versioning';
$route['admin-panel/configuration'] = 'auth_panel/configuration/configuration/configuration';
/*routing for admin panel end */


/*routing for api panel start */
$route['api_panel/login'] = 'data_model/login/login/login_authentication';
$route['api_panel/register_device'] = 'data_model/login/login/register_device';
$route['api_panel/get_employee_list'] = 'data_model/login/login/get_employee_list';
$route['api_panel/get_employee_by_keyword'] = 'data_model/attendance/attendance/get_employee_by_keyword';
$route['api_panel/update_in_out_time'] = 'data_model/attendance/attendance/update_in_out_time';
$route['api_panel/get_latest_attendance_count'] = 'data_model/attendance/attendance/get_latest_attendance_count'; 
$route['api_panel/visitor_registration'] = 'data_model/visitor/visitor/visitor_registration';
$route['api_panel/get_visitor_list'] = 'data_model/visitor/visitor/get_visitor_list';
$route['api_panel/get_visitor_by_keyword'] = 'data_model/visitor/visitor/get_visitor_by_keyword';
$route['api_panel/update_visitor_in_out_time'] = 'data_model/visitor/visitor/update_visitor_in_out_time';
$route['api_panel/get_updated_visitor_count'] = 'data_model/visitor/visitor/get_updated_visitor_count';
$route['api_panel/get_to_whome_list'] = 'data_model/visitor/visitor/get_to_whome_list';
$route['api_panel/get_to_whome_by_keyword'] = 'data_model/visitor/visitor/get_to_whome_by_keyword';
$route['api_panel/get_employee_attendance_report'] = 'data_model/attendance/attendance/get_employee_attendance_report';
/*routing for api panel end */

