<?php 
	checkLogin('1 2');
	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		$username = $_REQUEST["username"];
		$contact_name = $_REQUEST["contact_name"];
		$email = $_REQUEST["email"];
		$phone = $_REQUEST["phone"];
		$priority = $_REQUEST["priority"];
		$message_subject = $_REQUEST["subject"];
		$enquiry_message = $_REQUEST["message"];
			{
				$msg = "Username:\t$username\n
						Contact Name:\t$contact_name\n
						Email:\t$email\n
						Phone:\t$phone\n
						Priority:\t$priority\n
						Subject:\t$message_subject\n						
						Message:\t$enquiry_message\n\n\n";
				$to      = '$support_email';
				$subject = 'WebEgg CMS - Support Request';
				$headers = 'From: $username' . "\r\n" .
					'Reply-To: $no-reply@webegg.com.au' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $msg, $headers);
				$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Your support request has been submitted! You may view your ticket through the ticket system.</strong></li>';
			}
	}
	?>

	<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Online Support</h2>
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
                                                          
                            <p>
                               Please use the form below to contact our support team.
							   <br /><br />
							   This section is designed for all general support enquiries. If you support request requires urgent attention please use the SOS support request.
                            </p>
                            <ul class="system_messages">
								<?php echo "$update_message"; ?>
							</ul>
                            
                            <!--[if !IE]>start forms<![endif]-->
                            <form action="<?=$_SERVER['PHP_SELF']?>?page=contact_support" method="post" class="search_form general_form">
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <input type="hidden" name="_submit_check" value="1"/> 
									<input type="hidden" name="module" value="support"/> 
									<input type="hidden" name="page" value="contact_support"/> 
                                    <label for="username">Username</label>
                                    <input class="input" type="text" readonly="true" id="username" name="username" size="32" value="<?php echo get_username ( $_SESSION['user_id'] ); ?>" />
									<br /><br />
									<label for="username">Contact Name</label>
									<input class="input" type="text" id="contact_name" name="contact_name" size="32" /><br /><br />
									<label for="username">Email</label>
									<input class="input" type="text" id="email" name="email" size="32" /><br /><br />
									<label for="username">Phone</label>
									<input class="input" type="text" id="phone" name="phone" size="32" />
									<br /><br /><br /><br />
									<label for="username">Priority</label>
                                    <select id="priority" name="priority">
										<option value="Low" style="color:#CCCCCC">Low</option>
										<option value="Medium" style="color:#0099FF">Medium</option>
										<option value="High" style="color:#000000">High</option>
										<option value="Critical" style="color:#FF6600">Critical</option>
										<option value="Emergency" style="color:#FF0000">Emergency</option>
									</select>
                                    <br /><br />
									<label for="username">Subject</label>
									<input class="input" type="text" id="subject" name="subject" size="32" />
                                    <br /><br />
                                    <label for="password">Message</label>
                                    <textarea id="message" name="message" cols="50" rows="10"/></textarea>
                                    <br /><br />
                                     <div class="row">
                                        <div class="buttons">
                                            <ul>
												<li><span class="button send_form_btn"><span><span>SUBMIT</span></span><input name="submit" type="submit" /></span></li>
                                                <li><span class="button cancel_btn"><span><span>BACK</span></span><input name="" onclick="javascript:history.back()" /></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
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
