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

$route['default_controller']    = 'Login';
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;



/* ==================== Custom Routes =======================*/


// Login Routes
$route['OTP']                           = 'Login/otp';
$route['password-recovery']             = "Login/password_recovery";
$route['verify-email']                  = "Login/verify_email";
$route['forget-otp']                    = 'Login/verify_otp_forget_password';
$route['reset-password/(:any)/(:any)/(:any)'] = 'Login/reset_password/$1/$2/$3';
$route['update-forget-password']        = "Login/update_forget_password";


// Dashboard Routes
$route['Dashboard']                     = "Dashboard/index";
$route['change-password']               = 'Settings/change_password';

// Users Route
$route['create-user']                   = "User/create";
$route['list-user']                     = "User/list_user";
$route['save-user']                     = "User/store";
$route['edit-user/(:num)']              = "User/edit_user/$1";
$route['update-user']                   = "User/update_user";
$route['delete-user']                   = "User/delete_user";
$route['block-user/(:num)']             = "User/block_user/$1";
$route['active-user/(:num)']            = "User/active_user/$1";

// ClientAdmin Route
$route['create-client']                   = "Client/create";
$route['list-client']                     = "Client/list_user";
$route['save-client']                     = "Client/store";
$route['edit-client/(:num)']              = "Client/edit_user/$1";
$route['update-client']                   = "Client/update_user";
$route['delete-client']                   = "Client/delete_user";
$route['block-client/(:num)']             = "Client/block_user/$1";
$route['active-client/(:num)']            = "Client/active_user/$1";

 
$route['RecievedClientsJob/live-job']                      = "RecievedClientsJob/index";
$route['RecievedClientsJob/hold-job']                      = "RecievedClientsJob/index";
$route['RecievedClientsJob/completed-job']                 = "RecievedClientsJob/index";
$route['RecievedClientsJob/draft-job']                     = "RecievedClientsJob/index";
$route['RecievedClientsJob/view-history']                  = "RecievedClientsJob/index";

$route['ClientsNotification']                              = 'Adminnotification/ClientsNotification';
$route['EmployeeNotification']                             = 'Adminnotification/EmployeeNotification';


$route['EmpClientsJob/live-job']                      = "EmpClientsJob/index";
$route['EmpClientsJob/hold-job']                      = "EmpClientsJob/index";
$route['EmpClientsJob/completed-job']                 = "EmpClientsJob/index";
// $route['EmpClientsJob/draft-job']                     = "EmpClientsJob/index";
$route['EmpClientsJob/view-history']                  = "EmpClientsJob/index";




// Notification Routes
$route['read-notification/(:num)']      = 'Activities/read_notification/$1';
$route['create-notification']           = 'Activities/create_notification';
$route['send-notification'] 	        = "Activities/send_notification";
$route['sent-notifications']            = "Activities/sent_notifications";
$route['delete-notification']           = "Activities/delete_notification";
$route['edit-notification/(:num)']      = "Activities/edit_notification/$1";
$route['update-notification']           = "Activities/update_notification";

// IP LIST
$route['ip-list']                       = "Ip/index";
$route['assign-ip']                     = "Ip/assign_ip";
$route['delete-ip']                     = "Ip/delete_ip";

// clients portal
$route['ClientsOTPVerification']		= 'Clients/ClientsOTPVerification';
$route['OTPVerification']               = "Client/OTPVerification";
$route['ClientDashboard']               = 'Clients/dashboard';
$route['ClientForgetPassword']          = 'Clients/ClientForgetPassword';
$route['ClientsSetNewPassword']			= 'Clients/ClientsSetNewPassword';

$route['ClientsAddNewJobs']				= 'Clients/ClientsAddNewJobs';
$route['ClientsJobsList']				= 'Clients/ClientsJobsList';
$route['ClientsNotification']			= 'Clients/ClientsNotification';
$route['clientProfileInformation']		= 'Clients/clientProfileInformation';
$route['logout-client']                 = 'Clients/logout_client';

// Avinash
$route['jobCommentForm']		        = 'Clients/jobCommentForm';
$route['get_job_details']		        = 'Clients/get_job_details';

// 30-04-2025 Team Avinash
$route['updateProfile']		            = 'Login/updateProfile';
$route['updatePassword']		        = 'Login/updatePassword';

$route['FetchBarChart']                 = 'Clients/FetchBarChart';
$route['FetchBarCharti/(:num)']         = 'Clients/FetchBarCharti/$1';

$route['clientJobHistories/(:any)'] = 'Clients/clientJobHistories/$1';

$route['RecievedClientsJobHistories/(:any)'] = 'RecievedClientsJob/clientJobHistories/$1';

$route['RecievedClientsJob']        = 'RecievedClientsJob/index';

$route['AdminEmpNotify/Client']     = 'AdminEmpNotify/index';
$route['AdminEmpNotify/Employee']   = 'AdminEmpNotify/index';
$route['AdminEmpNotify']            = 'AdminEmpNotify/index';

$route['EmpNotify/Client']     = 'EmpNotify/index';
$route['EmpNotify/Employee']   = 'EmpNotify/index';
$route['EmpNotify']            = 'EmpNotify/index';

