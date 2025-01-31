<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| Display Debug backtrace

|--------------------------------------------------------------------------

|

| If set to TRUE, a backtrace will be displayed along with php errors. If

| error_reporting is disabled, the backtrace will not display, regardless

| of this setting

|

*/

defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);

defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);

defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);

defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/

defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');

defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');

defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care

defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care

defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');

defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');

defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');

defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');



/*

|--------------------------------------------------------------------------

| Exit Status Codes

|--------------------------------------------------------------------------

|

| Used to indicate the conditions under which the script is exit()ing.

| While there is no universal standard for error codes, there are some

| broad conventions.  Three such conventions are mentioned below, for

| those who wish to make use of them.  The CodeIgniter defaults were

| chosen for the least overlap with these conventions, while still

| leaving room for others to be defined in future versions and user

| applications.

|

| The three main conventions used for determining exit status codes

| are as follows:

|

|    Standard C/C++ Library (stdlibc):

|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html

|       (This link also contains other GNU-specific conventions)

|    BSD sysexits.h:

|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits

|    Bash scripting:

|       http://tldp.org/LDP/abs/html/exitcodes.html

|

*/

defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors

defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error

defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error

defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found

defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class

defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member

defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input

defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error

defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code

defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



// ==================== NOTIFICATION CREDENTIALS ===================



define("GSM_KEY",'');// for android...

define("TEAM_ID",'');//for ios...

define("KEY_ID",'');//for ios...



// ==================== TEMPLATE CONSTANTS ===================

define("CONFIG_PROJECT_DOMAIN",'https://sep.sanskargroup.in/');

define("CONFIG_PROJECT_ROOT_NAME",'SANSKAR');

define("CONFIG_PROJECT_FULL_NAME",'EMPLOYEE PORTAL'); 

define("CONFIG_PROJECT_NICK_NAME",'Employee Portal');

define("CONFIG_PROJECT_GLOBAL_NAME",'SANSKAR EMPLOYEE PORTAL');

define("CONFIG_PROJECT_GLOBAL_NICK_NAME",'Sanskar Employee Portal');

define("CONFIG_PROJECT_SUBDOMAIN_NAME",'');

define("CONFIG_PROJECT_DIR_NAME",'sanskar_employee_portal');



// ==================== REDIS CREDENTIALS ===================



define("CONFIG_REDIS_HOST", '127.0.0.1');

define("CONFIG_REDIS_PASSWORD", '');

define("CONFIG_REDIS_PORT", '6379');





// ==================== URL's ===================



define("API_URL", 'https://sep.sanskargroup.in/');

define("WEB_URL", 'https://sep.sanskargroup.in/');

define("ADMIN_ASSETS", 'https://sep.sanskargroup.in/auth_panel_assets/assets');



// ==================== MAXIMUM LOGIN DEVICE LIMIT ===================



//define("DEVICE_LIMIT", 5);





// ==================== AWS CREDENTIALS ===================

define("AMS_REGION", 'ap-south-1');

define("AMS_BUCKET_NAME", '');

define("AMS_S3_KEY", '');

define("AMS_SECRET", '');

define("AMS_BUCKET_BASE",'https://'.AMS_BUCKET_NAME.'.s3.'.AMS_REGION.'.amazonaws.com/');



// ==================== RAZORPAY CREDENTIALS ===================

// 

//test mode...

define('RAZORPAY_ID', '');

define('RAZORPAY_PASSWORD', '');



//live mode...

//define('RAZORPAY_ID', 'rzp_test_wlwMtEPTnFcCm2');

//define('RAZORPAY_PASSWORD', 'qLk6BkrbapF9cyMYewgtugVT');



// ==================== YOUTUBE KEY CREDENTIALS ===================

define('API_key', '');





// ==================== SMS TEMPLATE CREDENTIALS ===================
define('PEID', '1201160776205482092');
define('TEMPLATEID_ONE', '1207162029837018991');//Your otp is {#var#}.Sanskar
define('TEMPLATEID_TWO', '1207162072703347697');//Dear User, Your OTP for Sanskar mobile verification is {#var#}.Sanskar Tv

//define('INDEX_PHP', 'index.php/');
define('INDEX_PHP', '');


?>
