<?php 
	
	include "../../../settings.php";
	
	$id = $_REQUEST['id'];
	$maillist_id = $_REQUEST['maillist_id'];
	
	$db->query("DELETE FROM contacts_maillists_members WHERE contacts_id = '$id'") ;
	
	header ("../../../default_content.php?page=manage_lists_members&module=contacts&id=".$maillist_id"&status_message=Contact%20removed%20from%20list");
?>