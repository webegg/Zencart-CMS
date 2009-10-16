<?php 
	$db->select("$dbprefix$username");
	
	$id = $_REQUEST['id'];
	if(isset($_POST['submit'])){ 
		@extract($_REQUEST);
		
		if ($id == '') { 
			$db->query("INSERT INTO property_agents (agent_name, address_1, address_2, address_3, address_4, phone, fax, mobile, email) VALUES ('$agent_name','$address_1','$address_2','$address_3','$address_4','$phone','$fax','$mobile','$email')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Agent successfully added!</strong></li>';
		} else {
		$db->query("UPDATE property_agents SET agent_name='$agent_name',address_1='$address_1',address_2='$address_2',address_3='$address_3',address_4='$address_4',phone='$phone',fax='$fax',mobile='$mobile',email='$email' WHERE agent_id='$agent_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Agent successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM property_agents WHERE agent_id='$id'";
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
         Agent</h2>
        
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
							<input type="hidden" name="page" value="edit_agent"/> 
							<input type="hidden" name="module" value="property"/> 
							<input type="hidden" name="id" value="<?php echo $row->agent_id?>" />
							<input type="hidden" name="agent_id" value="<?php echo $row->agent_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Name:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="agent_name" name="agent_name" value="<?php echo $row->agent_name?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Street:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="address_1" name="address_1" value="<?php echo $row->address_1?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Suburb:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="address_2" name="address_2" value="<?php echo $row->address_2?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>State:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="address_3" name="address_3" value="<?php echo $row->address_3?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Postcode:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="address_4" name="address_4" value="<?php echo $row->address_4?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->	
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Phone:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="phone" name="phone" value="<?php echo $row->phone?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Fax:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="fax" name="fax" value="<?php echo $row->fax?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Mobile:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="mobile" name="mobile" value="<?php echo $row->mobile?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                     <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Email:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="email" name="email" value="<?php echo $row->email?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                     <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Image:</label>
                                        <div class="inputs">
                                           <input type="file" id="image" name="image" />
                                            
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
