<?php
$pageURL = 'http';
if ($_SERVER["HTTPS"] == "on") 
{
	$pageURL .= "s";
}
	$pageURL .= "://";
if($_SERVER["SERVER_PORT"] != "80")
{
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
}
else 
{
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
if($pageURL == siteinfo('siteurl')."depositipn.php")
{
	?>
    <h3>You cannot access this page directly !!</h3>
    <?php
	exit();
}
?>