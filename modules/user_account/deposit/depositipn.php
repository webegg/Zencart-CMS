<?php
include("config.inc.php");
include("siteinfo.php");
//include("geturl.php");
//paypal or sandbox?
	if(siteinfo('paypal') == "sandbox")
	{
		$paypalaction = "ssl://www.sandbox.paypal.com";
	}
	elseif(siteinfo('paypal') == "paypal")
	{
		$paypalaction = "ssl://www.paypal.com";
	}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) 
{
	$value = urlencode(stripslashes(mysql_real_escape_string($value)));
	$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ($paypalaction, 443, $errno, $errstr, 30);

// assign posted variables to local variables
$user_id = mysql_real_escape_string($_POST['custom']);
$txn_id = mysql_real_escape_string($_POST['txn_id']);
$payment_amount = mysql_real_escape_string($_POST['mc_gross']);
$receiver_email = mysql_real_escape_string($_POST['receiver_email']);
$payer_email = mysql_real_escape_string($_POST['payer_email']);

if ($fp) 
{
	fputs ($fp, $header . $req);
	while (!feof($fp)) 
	{
		$res = fgets ($fp, 1024);
		if (strcmp ($res, "VERIFIED") == 0) 
		{
			//allready exist
			$sql = "SELECT * FROM deposit_history WHERE unique_code = '$txn_id'";
			$result = mysql_query($sql);
			$check = mysql_num_rows($result);
			if($check == 0)
			{
				// PAYMENT VALIDATED & VERIFIED!
				//store amount with .00
				$amount = $payment_amount;
				//grab the current amount
				$depositcash = mysql_fetch_object(mysql_query("SELECT Username,Email,deposit FROM users WHERE id = '$user_id'"));
				//add the paid amount to it
				$cash = $depositcash->deposit+$amount;
				//store it in the database
				if(!mysql_query("UPDATE users SET deposit=".$cash." WHERE id = '$user_id'")) { die(mysql_error()); }
				//add transaction in deposit history
				if(!mysql_query("INSERT INTO deposit_history (user_id, unique_code, amount) VALUES ('$user_id','$txn_id','$amount')")) { die(mysql_error()); }
				$headers = "From:".siteinfo("adminmail")."\r\n"; 
				$mailmessage ="
					Dear ".$depositcash->username."
					
					Thank you for your deposit on the CMS tutorial site. Your account should have been credited with $".$amount.".00
					You can always view your deposit history by going to ".siteinfo('siteurl')."/deposit_history.php
					
					If you have any problem whatsoever you can always contact us at #TODO VOEG ADMIN EMAIL IN CONFIG DATABASE
					
					Kind regards
					yoursite.com
				";
				mail($payer_email,"Your deposit",$mailmessage,$headers);
			}
			else
			{
				$headers = "From:".siteinfo("adminmail")."\r\n"; 
				$mailmessage ="
					Dear ".$depositcash->username."
					
					The tax id of your payment allready exist and cannot be processed. You cannot process the same payment twice.
					
					Kind regards
					yoursite.com
				";
				mail($payer_email,"Your deposit failed",$mailmessage,$headers);
			}
		}
		elseif (strcmp ($res, "INVALID") == 0) 
		{
			// PAYMENT INVALID & INVESTIGATE MANUALY!
			$headers = "From:".siteinfo("adminmail")."\r\n"; 
			$mailmessage ="
				Dear ".$depositcash->username."
				
				We were unable to credit the  $".$amount.".00 to your account. If you still have this problem you can always contact us and request a manual deposit to your account.
				
				Kind regards
				yoursite.com
			";
			mail($payer_email,"Failure of your deposit",$mailmessage,$headers);
		}
	}
fclose ($fp);
}
?>
