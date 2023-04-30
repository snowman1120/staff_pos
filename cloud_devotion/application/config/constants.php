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


/**** USER DEFINED CONSTANTS **********/

define('ROLE_GUEST',                       0);
define('ROLE_STAFF',                       1);
define('ROLE_COMPANY',                     2);
define('ROLE_ADMIN',                       99);

define('SEGMENT',								3);

/************************** EMAIL CONSTANTS *****************************/

define('EMAIL_FROM',                          'noreply@proz.jp');		// e.g. email@example.com
define('EMAIL_BCC',                            	'');		// e.g. email@example.com
define('FROM_NAME',                          'Prozチャットボットシステム');	// Your system name
define('EMAIL_PASS',                            '');	// Your email password
define('PROTOCOL',                             	'smtp');				// mail, sendmail, smtp
define('SMTP_HOST',                             'smtp.gmail.com');		// your smtp host e.g. smtp.gmail.com
define('SMTP_PORT',                             '25');					// your smtp port e.g. 25, 587
define('SMTP_USER',                             '');		// your smtp user
define('SMTP_PASS',                             '');	// your smtp password
define('MAIL_PATH',                             '/usr/sbin/sendmail');


//Wix Answer API
//define('WIX_API_URL', 'https://anker.wixanswers.com/api/v1/');
//define('WIX_API_KEY', '06e6d9ea-c375-451d-9d83-93e9ae892b1d');
//define('WIX_API_SECRET', 'quk8I2JJRsXfmMA9uHkJDv5EqnfSCcQRn-MtNY702ok');
//

//SAPPORO API
//define('WIX_API_URL', 'https://sapporo.wixanswers.com/api/v1/');
//define('WIX_API_KEY', 'fea1272d-3c03-4055-9d2c-a390c246c329');
//define('WIX_API_SECRET', 'GsAniOm010qMsEPCtzrn3dhu0TnkeXQTRzWljbFqS0w');

define('WORK_START', 10);
define('WORK_END', 19);

$attendance_status = array(
	1 => '出勤',
	2 => '退勤'
);

define('ATTENDANCE_STATUS', $attendance_status);

$reserve_status = array(
    'request' => 1,
    'apply' => 2,
    'reject' => 3,
    'cancel' => 4,
    'entering' => 5,
    'complete' => 6
);

define('RESERVE_STATUS', $reserve_status);

define('SHIFT_STATUS_SUBMIT', 1);
define('SHIFT_STATUS_REJECT', 2);
define('SHIFT_STATUS_OUT', 3);
define('SHIFT_STATUS_REST', 4);
define('SHIFT_STATUS_REQUEST', 5);
define('SHIFT_STATUS_ME_REJECT', 6);
define('SHIFT_STATUS_ME_REPLY', 7);
define('SHIFT_STATUS_ME_APPLY', 9);
define('SHIFT_STATUS_APPLY', 10);

$shift_staus_array = array(
    SHIFT_STATUS_SUBMIT => '申請中',
    SHIFT_STATUS_REJECT => '拒否',
    SHIFT_STATUS_OUT => '店外待機',
    SHIFT_STATUS_REST => '休み',
    SHIFT_STATUS_REQUEST => '出勤依頼',
    SHIFT_STATUS_ME_REJECT => '出勤依頼 - 拒否',
    SHIFT_STATUS_ME_REPLY => '回答済み',
    SHIFT_STATUS_ME_APPLY => '回答済み-承認',
    SHIFT_STATUS_APPLY => '承認',
);
define('SHIFT_STATUS_COMMENTS', $shift_staus_array);

define('STAFF_AUTH_GUEST', 0);
define('STAFF_AUTH_STAFF', 1);
define('STAFF_AUTH_BOSS', 2);
define('STAFF_AUTH_MANAGER', 3);
define('STAFF_AUTH_OWNER', 4);
define('STAFF_AUTH_ADMIN', 5);

define('ORDER_STATUS_NONE', 0);
define('ORDER_STATUS_RESERVE_REQUEST', 1);
define('ORDER_STATUS_RESERVE_REJECT', 2);
define('ORDER_STATUS_RESERVE_CANCEL', 3);
define('ORDER_STATUS_RESERVE_APPLY', 4);
define('ORDER_STATUS_TABLE_REJECT', 5);
define('ORDER_STATUS_TABLE_START', 6);
define('ORDER_STATUS_TABLE_END', 7);
define('ORDER_STATUS_TABLE_COMPLETE', 8);

define('PAY_METHOD_CREDIT', 1);
define('PAY_METHOD_CASH', 2);
define('PAY_METHOD_OTHER', 3);

define('RESERVE_CONDITION_OK', 1);
define('RESERVE_CONDITION_ENABLE', 2);
define('RESERVE_CONDITION_DISABLE', 3);

define('SQUARE_ENDPOINT_HOST', 'https://connect.squareupsandbox.com/');

$week_array = array('日', '月', '火', '水', '木', '金', '土');

define('WEEKS', $week_array);
