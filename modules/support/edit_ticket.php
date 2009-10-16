<?php 
	$id = $_REQUEST['id'];
	$db->query("UPDATE support SET read_status='0' WHERE support_id='$support_id'");
	if(isset($_POST['submit'])){ 
		$reply_message = $_REQUEST['reply_message'];
			$db->query("INSERT INTO support_response (support_id, message) VALUES ('$id', '$reply_message')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Your reply has successfully been submitted!</strong></li>';
			{
				$msg = "Username:\t$username\n					
						Message:\t$reply_message\n\n\n";
				$to      = '$support_email';
				$subject = 'WebEgg CMS - Support Ticket Reply';
				$headers = 'From: $username' . "\r\n" .
					'Reply-To: $no-reply@webegg.com.au' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $msg, $headers);
			}
	}
	
	$query = "SELECT * FROM support WHERE support_id='$id'";
	$row = $db->getRow ( $query );	
?>
<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Support Ticket Details</h2>
        
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
                                                        
                            <!--<p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit, nisl sit amet iaculis ullamcorper, orci tellus feugiat est, at dapibus massa dui vel lectus. Sed felis nunc, pharetra ullamcorper, fermentum nec, cursus nec, ipsum. Nunc porta blandit risus. Proin pharetra. Proin ultrices viverra lorem. Phasellus tellus enim, accumsan et, luctus vitae, mattis in, diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vulputate, arcu consectetur auctor lacinia, justo est suscipit massa, a 
                            </p>-->
                            
                            
                            <!--[if !IE]>start forms<![endif]-->
							<ul class="system_messages">
								<?php echo "$update_message"; ?>
							</ul>
                            <form action="<?=$_SERVER['PHP_SELF']?>" class="search_form general_form" method="post">
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="edit_ticket"/> 
							<input type="hidden" name="id" value="<?php echo $row->support_id?>" />
							<input type="hidden" name="support_id" value="<?php echo $row->supoort_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Subject:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="subject" readonly="true" name="subject" value="<?php echo $row->subject?>" size="50"/></span>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Message:</label>
                                        <div class="inputs">
                                            <textarea class="text" name="message" id="message" readonly="true" rows="10" cols="60"><?php echo $row->message ?></textarea>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
				<?php if ( $support_reply = $db->get_results("SELECT * FROM support_response WHERE support_id = '$id' ORDER BY timestamp ASC") )
						{
						  foreach( $support_reply as $support_reply)
						   { ?>
						    <div class="row">
                                        <label>Reply From<br /><span style="color:#0066FF; font-style:italic"><?php echo $support_reply->username; ?></span></label>
                                        <div class="inputs">
                                            <textarea class="text" name="message" readonly="true" id="message" rows="5" cols="60"><?php echo $support_reply->message; ?></textarea>
                                        </div>
                                    </div>

									<?php } } else {  ?>
											There are no responses to this support ticket	
									<?php } ?>						
                                    <!--[if !IE]>start row<![endif]-->
									 
									
									<div class="row">
                                        <label>New Reply:</label>
                                        <div class="inputs">
                                            <textarea class="text" name="reply_message" id="reply_message" rows="5" cols="60"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="buttons">
                                            
                                            
                                            <ul>
                                                <li><span class="button cancel_btn"><span><span>BACK</span></span><input name="" onclick="javascript:history.back()" /></span></li>

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
