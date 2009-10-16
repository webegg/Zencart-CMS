<?php 
	checkLogin('1 2');
	if ( array_key_exists ( '_submit_check', $_POST ) )
	{
		$username = $_REQUEST["username"];
		$message = $_REQUEST['message'];
		{
		//clickatell integration for emergency sms support request
			$user = "grayd";
			$password = "2xrgeb25";
			$api_id = "3128679";
			$baseurl ="http://api.clickatell.com";
			$text = urlencode("Support request from $username. $message");
			$to = "0423121203";
			// auth call
			$url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
			// do auth call
			$ret = file($url);
			// split our response. return string is on first line of the data returned
			$sess = split(":",$ret[0]);
			if ($sess[0] == "OK") {
			$sess_id = trim($sess[1]); // remove any whitespace
			$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
			// do sendmsg call
			$ret = file($url);
			$send = split(":",$ret[0]);
			
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Your support request has been submitted!</strong></li>';
		}
	}
	?>

	<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Emergency Support Request</h2>
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
							   <b>THIS SECTION IS DESIGNED FOR EMERGENCY SUPPORT REQUESTS ONLY!<br />YOU MAY BE CHARGED FOR ALL SUPPORT OFFERED THROUGH THIS SERVICE DEPENDING ON THE CAUSE OF THE PROBLEM.</b>
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
                                    <label for="password">Message</label>
									<input maxlength="100" name="message" id="message" size="50"/>
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
