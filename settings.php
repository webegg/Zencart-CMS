<?php
$directory_string = 'c:/wamp/www/Zencart-CMS/';
//$directory_string = '/var/www/html/myegg/';

$html_string = 'http://localhost/Zencart-CMS/';
//$directory_string = '/var/www/html/myegg/';

require_once ( "".$directory_string."lib/connection.php" );			// - the connection class needed to operate with mysql
require_once ( "".$directory_string."functions.php" );				// - the functions



/*
|---------------------------------------------------------------
| SYSTEM VARIABLES
|---------------------------------------------------------------
|
| System variables needed by the application
|
*/
define ( "HOSTNAME", "localhost" );			// - hostname - nedded to access the database
define ( "DATABASE", "webegg_com_au_global" );				// - database name - the name of your mysql database
define ( "DBUSER", "root" );				// - database user - what user should we use to access the database
define ( "DBPASS", "a327310" );			// - database password - what password should we use to access the database
define ( "DBPREFIX", "" );				// - db prefix - would you like to use a prefix for your table?
define ( "APPLICATION_URL", "http://localhost/Zencart-CMS" );// - app. url - the url that points to our application ( ! with trailing slash )
define ( "APPLICATION_FOLDER", "members" );		// - do we have a folder where we store our scripts? ( ! no slashes )
define ( "REDIRECT_TO_LOGIN", "login.php" );		// - where should we redirect visitors if the access is restricted?
define ( "REDIRECT_AFTER_LOGIN", "members.php" );	// - where should we redirect members after logging in?
define ( "REDIRECT_ON_LOGOUT", "login.php" );		// - where should we redirect on logout?
define ( "ADMIN_EMAIL", "daniel@webegg.com.au" );	// - what email should we use to contact our members?
define ( "KEEP_LOGGED_IN_FOR", 60*60*24*100 );		// - if they chose to be remembered, how long should the cookies remain active ( default is 100 days )
define ( "COOKIE_PATH", "/" );				// - where should the cookies be active ( '/' means the whole domain. )
define ( "DOMAIN_NAME", "www.webegg.com.au" );		// - the domain name that we use
define ( "RUN_ON_DEVELOPMENT", FALSE );			// - TRUE if you wish to see the nasty errors for debugging, FALSE to hide them
define ( "REDIRECT_AFTER_CONFIRMATION", TRUE );		// - TRUE if you want to redirect your users to the members page after they confirm their membership
define ( "ALLOW_USERNAME_CHANGE", TRUE );		// - do we let our members update their usernames as well? ( FALSE stands for no )
define ( "ALLOW_REMEMBER_ME", TRUE );			// - do we let our members use the "remember me" feature
$support_email = 'daniel@webegg.com.au';
$support_mobile = '0423121203';
$dbprefix = 'webegg_com_au_';
$site_url = 'http://www.webegg.com.au/myegg/';
$site_http = 'http://www.webegg.com.au/myegg/';
$paypal_email = 'daniel@webegg.com.au';
$paypal_currency_code = 'AUD';
$paypal_location = 'AU';

/*
|---------------------------------------------------------------
| EMAILING VARIABLES
|---------------------------------------------------------------
|
| Emailing variables needed by phpmailer
|
*/
define ( "USE_SMTP", FALSE );				// - do you want to use SMTP to send out emails? TRUE or FALSE ( mail() will be used )
define ( "SMTP_PORT", "" );				// - what port should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_HOST", "" );		// - what host should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_USER", "" );		// - what user should we use for smtp ( only needed if SMTP is set to TRUE )
define ( "SMTP_PASS", "" );		// - what password should we use for smtp (only needed if SMTP is set to TRUE)
define ( "MAIL_IS_HTML", TRUE );			// - send emails as html or text? ( TRUE for html and FALSE for text )
############################################################# DON'T EDIT BELOW THIS LINE ########################################


/*
|---------------------------------------------------------------
| SET THE SERVER PATH
|---------------------------------------------------------------
|
| Let's attempt to determine the full-server path to the "system"
| folder in order to reduce the possibility of path problems.
|
*/
if ( function_exists ( 'realpath' ) AND @realpath ( dirname (__FILE__) ) !== FALSE )
{
	define ( "BASE_PATH", str_replace ( "\\", "/", realpath ( dirname(__FILE__) ) ) . '/' );
}


//how do we handle errors
error_reporting ( ( RUN_ON_DEVELOPMENT ) ? E_ALL : E_WARNING );
if ( file_exists ( BASE_PATH . 'install.php' ) )
{
	die ( "Please delete install.php from your server before continuing!" );
}


$db = new db ( DBUSER, DBPASS, DATABASE, HOSTNAME );	// - and away we go
?>
