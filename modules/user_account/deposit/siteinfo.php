<?php
//##################### QUERIES & FETCH #######################//
//only run queries when asked for.
//not every database is the same so fill in these variables

//the name of your user table
$usertable ="user";

//the username column of your user table
$username ="username";

//the userid column of your user table
$userid ="user_id";

//the email column of your user table
$email ="email";

//the session or cookie, something to identify the user
$useridentify = 1;//mysqli_real_escape_string($link, $_SESSION['name of userid session']);

/*Some details for the PDF*/
//your company name (for the pdf)
$companyname = "WebEgg Pty Ltd";

//your company adress (for the pdf)
$companyadress = "PO Box 1955, SunnyBank Hills. Q4115";

//your company phone number(for the pdf)
$companynumber = "0000 00000000";

//footer details, disclaimer, whatever... (for the pdf)
$documentfooter = "If you have any disclaimer, type it here";

/*ERROR & OTHER MESSAGES*/
//when user tries to extend add but it doesn't exist
$error1="Sorry but your add does not exist.";

//message to display when user cancelled the deposit
$depositcancel = "We are sorry to hear you cancelled the deposit transaction. If any problem occured please Contact us";

//message to display when user deposited succesfully on his account
$depositsucces = "Thank you for the deposit, you can now start purchasing items, advertise your site or feature your tutorials.";

function siteinfo($param)
{
	global $link;
	$info = "";
	switch($param)
	{
		case 'siteurl':
			$info = mysql_fetch_object(mysql_query("SELECT siteurl FROM configuration"));
			$info = $info->siteurl;
		break;
		case 'sitename':
			$info = mysql_fetch_object(mysql_query("SELECT sitename FROM configuration"));
			$info = $info->sitename;
		break;
		case 'siteslogan':
			$info = mysql_fetch_object(mysql_query("SELECT siteslogan FROM configuration"));
			$info = $info->siteslogan;
		break;
		case 'sitedescription':
			$info = mysql_fetch_object(mysql_query("SELECT sitedescription FROM configuration"));
			$info = $info->sitedescription;
		break;
		case 'paypal':
			$info = mysql_fetch_object(mysql_query("SELECT paypal FROM configuration"));
			$info = $info->paypal;
		break;
		case 'adminmail':
			$info = mysql_fetch_object(mysql_query("SELECT email FROM configuration"));
			$info = $info->paypal;
		break;
	}
	return $info;
}

function userinfo($param)
{
	global $link;
	$info = "";
	switch($param)
	{
		case 'usertotal':
			//how many user have we? always usefull to know
			$info = mysql_num_rows(mysql_query("SELECT ".$userid." FROM ".$usertable.""));
		break;
		case 'username':
			$info = mysql_fetch_object(mysql_query("SELECT ".$username." FROM ".$usertable." WHERE ".$_SESSION['user_id'] ."='".$useridentify."'"));
			$info = $info->username;
		break;
	}
	return $info;
}
?>