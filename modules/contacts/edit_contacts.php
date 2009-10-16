<head>
<script type="text/javascript" src="js/tabber.js"></script>
<link rel="stylesheet" href="css/tabber.css" TYPE="text/css" MEDIA="screen">
<script type="text/javascript">

/* Optional: Temporarily hide the "tabber" class so it does not "flash"
   on the page as plain HTML. After tabber runs, the class is changed
   to "tabberlive" and it will appear. */

document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>
</head>
<?php 
	$db->select("$dbprefix$username");
	
	$id = $_REQUEST['id'];
	if(isset($_POST['submit'])){ 
		@extract($_REQUEST);
		
		if ($id == '') { 
			$db->query("INSERT INTO contacts (contacts_firstname, contacts_lastname, contacts_street, contacts_suburb, contacts_state, contacts_postcode, contacts_phone, contacts_mobile, contacts_email, email_opt_in, sms_opt_in, created_on, last_modified) VALUES ('$contacts_firstname', '$contacts_lastname', '$contacts_street', '$contacts_suburb', '$contacts_state', '$contacts_postcode', '$contacts_phone', '$contacts_mobile', '$contacts_email', '$email_opt_in', '$sms_opt_in', 'NOW', 'NOW')");
			$contacts_id = $db->get_var("SELECT contacts_id FROM contacts WHERE contacts_id = LAST_INSERT_ID()");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Contact successfully added!</strong></li>';
			$update_buttons = '<li><span class="button cancel_btn"><span><span>BACK TO CONTACTS</span></span><input name="" onclick="location:default_content.php?page=manage_contacts&module=contacts" /></span></li>';
		} else {
		$db->query("UPDATE contacts SET contacts_firstname = '$contacts_firstname', contacts_lastname='$contacts_lastname', contacts_street='$contacts_street', contacts_suburb='$contacts_suburb', contacts_state='$contacts_state', contacts_postcode='$contacts_postcode', contacts_phone='$contacts_phone', contacts_mobile='$contacts_mobile', contacts_email='$contacts_email', email_opt_in='$email_opt_in', sms_opt_in='$sms_opt_in', last_modified='NOW' WHERE contacts_id='$contacts_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Contact successfully updated!</strong></li>';
		$update_buttons = '<li><span class="button cancel_btn"><span><span>BACK TO CONTACTS</span></span><input name="" onclick="location:default_content.php?page=manage_contacts&module=contacts" /></span></li>';
		}
	}
	
	$query = "SELECT * FROM contacts WHERE contacts.contacts_id='$id'";
	$row = $db->getRow ( $query );

?>
<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>
        <?php
     if ($id == !'')
     {
         echo("Edit");
     } else {
		 echo("Add New");
	 }
?>
         Contact</h2>
        
        <!--[if !IE]>start section menu<![endif]-->
        <!--<ul class="section_menu">
            <li><a href="#"><span><span>Inactive Tab</span></span></a></li>
            <li><a href="#" class="active"><span><span>Active Tab</span></span></a></li>
            <li><a href="#"><span><span>Products</span></span></a></li>
            <li><a href="#"><span><span>Last One</span></span></a></li>
        </ul>-->
        <!--[if !IE]>end section menu<![endif]-->
        
        
        <span class="title_wrapper_left"></span>
        <span class="title_wrapper_right"></span>
    </div>
    <!--[if !IE]>end title wrapper<![endif]-->
    <!--[if !IE]>start section content<![endif]-->
    <div class="section_content">
        <!--[if !IE]>start section content top<![endif]-->
        <div class="sct">
            <div class="sct_left">
                <div class="sct_right">
                    <div class="sct_left">
                        <div class="sct_right">
   
                            <!--[if !IE]>start forms<![endif]-->
							<ul class="system_messages">
								<?php echo "$update_message"; ?>
							</ul>
                            <form action="<?=$_SERVER['PHP_SELF']?>" class="search_form general_form" method="post">
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="edit_contacts"/> 
							<input type="hidden" name="module" value="contacts"/> 
							<input type="hidden" name="id" value="<?php echo $row->contacts_id?>" />
							<input type="hidden" name="contacts_id" value="<?php echo $row->contacts_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
									
									 <div class="tabber">
                                    
                                         <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>General</h2>
                                            <p>
                                                <label>First Name:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_firstname" name="contacts_firstname" value="<?php echo $row->contacts_firstname?>" size="50"/>
                                                    </span>  
                                                    <br />
												<label>Last Name:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_lastname" name="contacts_lastname" value="<?php echo $row->contacts_lastname?>" size="50"/>
                                                    </span>  
                                                   
                                            </p>
                                            <div style="height:10px;"></div>
                                         </div>
										 
										 <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>Postage</h2>
                                            <p>
											<label>Street:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_street" name="contacts_street" value="<?php echo $row->contacts_street?>" size="50"/>
                                                    </span>  
                                                    <br />
												<label>Suburb:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_suburb" name="contacts_suburb" value="<?php echo $row->contacts_suburb?>" size="50"/>
                                                    </span>  
													<br />
													<label>State:</label>
                                                
                                                    <select name="contacts_state" id="contacts_state">
														<option value="<?php echo $row->contacts_state; ?>"><?php echo $row->contacts_state; ?></option>
														<option value="QLD">QLD</option>
														<option value="NSW">NSW</option>
														<option value="VIC">VIC</option>
														<option value="ACT">ACT</option>
														<option value="SA">SA</option>
														<option value="NT">NT</option>
														<option value="WA">WA</option>
													</select>
                                                    <br />
													
													<label>Postcode:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_postcode" name="contacts_postcode" value="<?php echo $row->contacts_postcode?>" size="50"/>
                                                    </span>  
											</p>
											  <div style="height:10px;"></div>
                                         </div>
										 <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>Phone / Email</h2>
                                            <p>
											<label>Phone:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_phone" name="contacts_phone" value="<?php echo $row->contacts_phone?>" size="50"/>
                                                    </span> 
													<br />
													<label>Mobile:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_mobile" name="contacts_mobile" value="<?php echo $row->contacts_mobile?>" size="50"/>
                                                    </span> 
													<br />
													<label>Email Address:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="contacts_email" name="contacts_email" value="<?php echo $row->contacts_email?>" size="50"/>
                                                    </span> 
											</p>
											  <div style="height:10px;"></div>
                                         </div>
										 <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>Marketing Mgmt.</h2>
                                            <p>
											 <label>Email Opt In:</label>

                                            <input type="radio" id="email_opt_in" name="email_opt_in" <?php if ($row->email_opt_in == '1') { ?> checked="checked"<?php } ?> value="1" />
											<br />
                                            <label>SMS Opt In:</label>

                                            <input type="radio" id="sms_opt_in" name="sms_opt_in" <?php if ($row->sms_opt_in == '1') { ?> checked="checked"<?php } ?> value="1" />
											
											</p>
											  <div style="height:10px;"></div>
                                         </div>
	 
                                    
									
									
									
									<br /><br />																										
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <div class="buttons">
                                            
                                            
                                            <ul>
                                                <li><span class="button send_form_btn"><span><span>SUBMIT</span></span><input name="submit" type="submit" /></span></li>
                                                <li><span class="button cancel_btn"><span><span>CANCEL</span></span><input name="" onclick="javascript:history.back()" /></span></li>
												<?php echo $update_buttons; ?>

                                            </ul>
                                            
                                           
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    
                                    
                                    </div>
                                    <!--[if !IE]>end forms<![endif]-->
                                    
                                </fieldset>
                                <!--[if !IE]>end fieldset<![endif]-->
                                
                                
                                
                                
                            </form>
                            <!--[if !IE]>end forms<![endif]-->	
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--[if !IE]>end section content top<![endif]-->
        <!--[if !IE]>start section content bottom<![endif]-->
        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
        <!--[if !IE]>end section content bottom<![endif]-->
        
    </div>
    <!--[if !IE]>end section content<![endif]-->
</div>
<!--[if !IE]>end section<![endif]-->
