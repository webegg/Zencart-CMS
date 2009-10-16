<?php

$db_host = "localhost";
$db_username = "webegg_root";
$db_password = "ingir65";
$db_database = "webegg_com_au_global";


$link = mysql_connect($db_host,$db_username,$db_password) or die("can't connect to database");

mysql_select_db($db_database) or die("Can't select database");
?>