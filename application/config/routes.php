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
$route['admin-panel/visitor-list'] = 'auth_panel/visitor_management/visitor_management/visitor_list';
$route['admin-panel/visitor-details/(:num)'] = 'auth_panel/visitor_management/visitor_management/visitor_details/$1';
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
/*routing for api panel end */

//$route['api_panel/login_app1'] = 'data_model/employee_app/employee/login_authentication';
$route['api_panel/login_app'] = 'data_model/employee_app/Login_user/login_authentication';
$route['api_panel/home_call'] = 'data_model/employee_app/Login_user/home_call';
$route['api_panel/set_pin'] = 'data_model/employee_app/Login_user/set_mo_pin';
$route['api_panel/check_pin'] = 'data_model/employee_app/Login_user/get_mo_pin';
$route['api_panel/leave_apply'] = 'data_model/employee_app/Login_user/leave_apply';
$route['api_panel/health_pdf_download'] = 'data_model/employee_app/Login_user/health_pdf_download';
$route['api_panel/Tour_app'] = 'data_model/employee_app/tour_Form/tour_Request';
$route['api_panel/tour_form'] = 'data_model/employee_app/tour_form/tour_Request';
$route['api_panel/employee_leave'] = 'data_model/employee_app/emp_leave/leave_request';
$route['api_panel/off_day'] = 'data_model/employee_app/emp_leave/offday_Request';
$route['api_panel/first_dose_vaccine'] = 'data_model/employee_app/vaccine_report/first_dose_vaccination';
//$route['api_panel/second_dose_vaccine'] = 'data_model/employee_app/vaccine_report/second_dose_vaccination';
$route['api_panel/advance_Request'] = 'data_model/employee_app/advance_Request/Advance_Form';
$route['api_panel/adv_request'] = 'data_model/employee_app/adv_request/advance_req_form';
$route['api_panel/pay_slip_request'] = 'data_model/employee_app/adv_request/pay_slip_request';
$route['api_panel/other_request'] = 'data_model/employee_app/adv_request/other_request';
$route['api_panel/work_from_home'] = 'data_model/employee_app/adv_request/work_from_home_request';
$route['api_panel/wfh_attendence'] = 'data_model/employee_app/adv_request/update_in_out_time';
$route['api_panel/get_markin_time'] = 'data_model/employee_app/adv_request/get_markin_time';
$route['api_panel/pl_summary_report'] = 'data_model/employee_app/pl_summary/pl_summary_report';
$route['api_panel/download_pl'] = 'data_model/employee_app/pl_summary/download_pl_pdf';
$route['api_panel/guest_request'] = 'data_model/employee_app/pl_summary/guest_request';
$route['api_panel/leave_cancellation'] = 'data_model/employee_app/emp_leave/leave_cancellation';
$route['api_panel/fetch_leave_cancellation'] = 'data_model/employee_app/emp_leave/fetch_leave_cancellation';
$route['api_panel/get_leave_requestList'] = 'data_model/employee_app/emp_leave/get_leave_requestList';
$route['api_panel/nf_nh_Request'] = 'data_model/employee_app/emp_leave/nf_nh_Request';
$route['api_panel/visitor_regst'] = 'data_model/employee_app/visitor/visitor_registration';