<?php
#### INCLUDE HEADER FILE OR CODE HERE#
//include("header.php");
#INCLUDE HEADER FILE OR CODE HERE#### 

#### INCLUDE CONFIGURATION FILE IF NOT ALLREADY DONE#
//if you allready have a configuration file
include("config.inc.php");
include ("../../../settings.php");
	checkLogin('1 2');

#INCLUDE CONFIGURATION FILE IF NOT ALLREADY DONE,#### 



include("siteinfo.php");
if(isset($useridentify))
{
	//paypal or sandbox?
	if(siteinfo('paypal') == "sandbox")
	{
		$paypalaction = "https://www.sandbox.paypal.com/cgi-bin/webscr";
	}
	elseif(siteinfo('paypal') == "paypal")
	{
		$paypalaction = "https://www.paypal.com/cgi-bin/webscr";
	}
	//check if cancelled
	$feedback="";
	if(isset($_GET['action']))
	{
		$action = mysqli_real_escape_string($link, $_GET['action']);
		if($action == "cancel")
		{
			$feedback = "<p class='error'>".$depositcancel."</p>";
		}
		elseif($action == "success")
		{
			$feedback = "<p class='succes'>".$depositsucces."</p>";
		}
	}
	//query current balance 
	//$cb=mysqli_fetch_object(mysqli_query($link, "SELECT deposit FROM ".$usertable." WHERE ".$userid." = ".$useridentify.""));
	$cb=mysqli_fetch_object(mysqli_query($link, "SELECT deposit FROM users WHERE ID = '1'"));
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="../../../css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->

<script type="text/javascript" src="../../../js/behaviour.js"></script>
<script type="text/javascript" src="../../../js/jquery.js"></script>
</head>

<body>
	<!--[if !IE]>start wrapper<![endif]-->
	<div id="wrapper">
	<?php include "../../../includes/header.php" ?>
		
		<!--[if !IE]>start content<![endif]-->
		<div id="content">
			<!--[if !IE]>start page<![endif]-->
			<div id="page">
			
				<div class="inner">
					<!--[if !IE]>start section<![endif]-->	
					<div class="section table_section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>My Account - Balance</h2>
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
                            
                          
                            <fieldset>
                            <!--[if !IE]>start table_wrapper<![endif]-->
									<fieldset>

		<?php echo $feedback; ?>
			<span style="font-size:16px; font-weight:bold; padding:10px;">$<?php echo $cb->deposit; ?>.00</span>
		</p>
		</fieldset>
		
                            
                            </fieldset>
                            
                            <fieldset>
		<legend>Deposit amount</legend>
		<h4>How much do you want to deposit?</h4>
		
				
			<p class="deposit">
				
	<?php
}
else
{
	?>
	<span class="notlogin">You are not logged in, please login or register</span>
	<?php } ?>
                            
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
					
					
					
				</div>
				
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar">
				<div class="inner">
					<!--[if !IE]>start quick info<![endif]-->
<div class="quick_info">
    <div class="quick_info_top">
        <h2>Make a Deposit</h2>
    </div>
    <div class="quick_info_content" align="center">
		<b>Deposit Value ($):</b><br /><input type="text" name="amount" size="10" /><br />
				<!--<input type="radio" name="amount" id="deposit_10" checked="checked" value="10.00"/><label for="deposit_10">$10.00</label>
				<input type="radio" name="amount" id="deposit_30" value="30.00"/><label for="deposit_10">$30.00</label>
				<input type="radio" name="amount" id="deposit_50" value="50.00" /><label for="deposit_10">$50.00</label>
			</p>
			<p class="deposit">
				<input type="radio" name="amount" id="deposit_70" value="70.00" /><label for="deposit_10">$70.00</label>
				<input type="radio" name="amount" id="deposit_90" value="90.00" /><label for="deposit_10">$90.00</label>
				<input type="radio" name="amount" id="deposit_100" value="100.00" /><label for="deposit_10">$100.00</label>-->
			</p>
		<br />
		
			<input type="image" src="https://www.paypal.com/en_US/BE/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	
		</form>

    </div>
    <span class="quick_info_bottom"></span>
</div>
<!--[if !IE]>end quick info<![endif]-->
					
					
					
				</div>
			</div>
			<!--[if !IE]>end sidebar<![endif]-->
			
			
			
			
		</div>
		<!--[if !IE]>end content<![endif]-->
		
	</div>
	<!--[if !IE]>end wrapper<![endif]-->
	<?php include "../../../includes/footer.php" ?>
	
</body>
</html>
		
	
