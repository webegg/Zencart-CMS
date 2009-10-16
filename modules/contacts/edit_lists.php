<?php 
	$db->select("$dbprefix$username");
	
	$id = $_REQUEST['id'];
	if(isset($_POST['submit'])){ 
		@extract($_REQUEST);
		
		if ($id == '') { 
			$db->query("INSERT INTO contacts_maillists (contacts_maillists_name, contacts_maillists_description, created_on, last_modified) VALUES ('$contacts_maillists_name', '$contacts_maillists_description', 'NOW', 'NOW')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Mail list successfully added!</strong></li>';
		} else {
		$db->query("UPDATE contacts_maillists SET contacts_maillists_name = '$contacts_maillists_name', contacts_maillists_description = '$contacts_maillists_description', last_modified = 'NOW' WHERE contacts_maillists_id='$contacts_maillists_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Mail list successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM contacts_maillists WHERE contacts_maillists.contacts_maillists_id='$id'";
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
         Mail List</h2>
        
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
							<input type="hidden" name="page" value="edit_lists"/> 
							<input type="hidden" name="module" value="contacts"/> 
							<input type="hidden" name="id" value="<?php echo $row->contacts_maillists_id?>" />
							<input type="hidden" name="contacts_maillists_id" value="<?php echo $row->contacts_maillists_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Mail List Name:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="contacts_maillists_name" name="contacts_maillists_name" value="<?php echo $row->contacts_maillists_name?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									 <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Mail List Description:</label>
                                        <div class="inputs">
                                            <textarea name="contacts_maillists_description" id="contacts_maillists_description" cols="50" rows="5"><?php echo $row->contacts_maillists_description; ?></textarea>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									
									
									

																											
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <div class="buttons">
                                            
                                            
                                            <ul>
                                                <li><span class="button send_form_btn"><span><span>SUBMIT</span></span><input name="submit" type="submit" /></span></li>
                                                <li><span class="button cancel_btn"><span><span>CANCEL</span></span><input name="" onclick="javascript:history.back()" /></span></li>

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
