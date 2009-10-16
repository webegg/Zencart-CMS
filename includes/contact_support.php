<?php 
	checkLogin('1 2');
	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		$username = $_REQUEST["username"];
		$enquiry_message = $_REQUEST["message"];
			{
				$msg = "Username:\t$username\n						
						Enquiry:\t$enquiry_message\n\n\n";
				$to      = 'daniel@webegg.com.au';
				$subject = 'BLFQ Trainee Module - Support Request';
				$headers = 'From: $username' . "\r\n" .
					'Reply-To: $no-reply@webegg.com.au' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
				mail($to, $subject, $msg, $headers);
				$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Your support request has been submitted!</strong></li>';
			}
	}
	?>

	<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Contact Support</h2>
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
									<input type="hidden" name="page" value="contact_support"/> 
                                    <label for="username">Username</label>
                                    <input class="input" type="text" id="username" name="username" size="32" value="<?php echo get_username ( $_SESSION['user_id'] ); ?>" />
                                    <br /><br />
                                    <label for="password">Message</label>
                                    <textarea id="message" name="message" cols="50" rows="10"/></textarea>
                                    <br /><br />
                                    <input type="submit" name="register" value="Send Support Request"  alt="submit" title="submit" />
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
