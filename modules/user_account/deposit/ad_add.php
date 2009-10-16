<?php
#### INCLUDE HEADER FILE OR CODE HERE#
//include("header.php");
#INCLUDE HEADER FILE OR CODE HERE#### 

#### INCLUDE CONFIGURATION FILE IF NOT ALLREADY DONE#
//if you allready have a configuration file comment next line
include("config.inc.php");
#INCLUDE CONFIGURATION FILE IF NOT ALLREADY DONE,#### 



include("siteinfo.php");
if(isset($useridentify))
	{
	//if action extend exist
	$feedback = "";
	$extend = "";
	$addsend = mysqli_query($link, "SELECT endson FROM links WHERE status=1 AND ".$userid."=".$useridentify."");
	$addsendon = mysqli_fetch_object($addsend);
	$depositmoney = mysqli_fetch_object(mysqli_query($link, "SELECT deposit FROM ".$usertable." WHERE ".$userid."=".$useridentify.""));
	if(isset($_GET['action']) && $_GET['action'] == "extend")
	{
		$addid = mysqli_real_escape_string($link, $_GET['add']);
		//check add if exist
		$checkadd = mysqli_query($link, "SELECT * FROM links WHERE id=".$addid."");
		$addnum = mysqli_num_rows($checkadd);
		//check if num row is 1, cause we are checking the id and they should be unique
		if($addnum == 1)
		{
			$extend ="
				<fieldset>
				<legend>For how long would you like to extend your advertisement?</legend>
				<p>This advertisement will end on ".date("d M Y", $addsendon->endson)."</p>
				<form action='".$siteinfo->siteurl."ad_add.php' method='post' name='extend_add'>
				<input type='hidden' name='addid' value='".$addid."'/>
				";
				if($depositmoney->deposit < 5)
				{
					$feedback = "<div class='error'>You don't have enough money on your account to advertise. 
					<a href='".$siteinfo->siteurl."/deposit/ad_add.php'>Click here</a> to deposit some money on your account</div>";
					$money = "disabled";
					$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";
				}
					$extend .="<p><input type='radio' name='extendtime' id='extendtime' ".$money." value='5'/> 1 Month / $5 ".$message."</p>";
				if($depositmoney->deposit < 10){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
					$extend .="<p><input type='radio' name='extendtime' id='extendtime' ".$money." value='10'/> 3 Month / $10 (save $5) ".$message."</p>";
				if($depositmoney->deposit < 20){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
					$extend .="<p><input type='radio' name='extendtime' id='extendtime' ".$money." value='20'/> 6 Month / $20 (save $10) ".$message."</p>";
				if($depositmoney->deposit < 30){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
					$extend .="<p><input type='radio' name='extendtime' id='extendtime' ".$money." value='30'/> 9 Month / $30 (save $15) ".$message."</p>";
				if($depositmoney->deposit < 40){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
					$extend .="<p><input type='radio' name='extendtime' id='extendtime' ".$money."  value='40'/> 12 Month / $40 (save $20) ".$message."</p>";
				$extend .="
				<p><input type='submit' name='extend' value='Extend your add' /></p>
				</form>
				</fieldset>
			 ";//end of extend
		}
		else
		{
			$feedback = "<div class='error'>".$error1."</div>";
		}
	}//if isset action and is extend
	if(isset($_POST['extend']))
	{
		if($_POST['extendtime'] != NULL)
		{
			//still filter because even if firebug is a great tool the user can use it to submit some nasty code
			$amount = mysqli_real_escape_string($link, $_POST['extendtime']);
			$addid = mysqli_real_escape_string($link, $_POST['addid']);
			//check if user still has enough money for this
			if($depositmoney->deposit >= $amount)
			{
				switch($amount)
				{
					case 5:
						$month = 1;
						$newdate = $addsendon->endson+60*60*24*30*$month;
					break;
					case 10:
						$month = 3;
						$newdate = $addsendon->endson+60*60*24*30*$month;
					break;
					case 20:
						$month = 6;
						$newdate = $addsendon->endson+60*60*24*30*$month;
					break;
					case 30:
						$month = 9;
						$newdate = $addsendon->endson+60*60*24*30*$month;
					break;
					case 40:
						$month = 12;
						$newdate = $addsendon->endson+60*60*24*30*$month;
					break;
				}
				//deduct the amount of his current balance
				$newamount = $depositmoney->deposit-$amount;
				mysqli_query($link, "UPDATE ".$usertable." SET deposit=".$newamount." WHERE ".$userid."=".$useridentify."");
				//extend the date of his advertisement
				mysqli_query($link, "UPDATE links SET endson=".$newdate." WHERE id=".$addid."");
				$feedback = "<div class='succes'>Succesfully extended your advertisement for another ".$month." months.</div>";
			}//end if user still has enough money
			else
			{
				$feedback= "<div class='error'>You don't have enough money to extend your advertisement</div>";
			}
		}
		else
		{
			$feedback = "<div class='error'>You did not select any option to extend your advertisement. <a href='javascript:history.go(-1)'>Go back</a> and select one of the available extending options</div>";
		}
	}//end of if forum extend was submitted
	if(isset($_POST['ads_addvert']))
	{
	$error = 0;
		if($_POST['Text'] == NULL || $_POST['Text'] == "http://" )
		{
			$feedback = "<div class='error'>No image given, enter an image please!</div>";
			$error = 1;
		}
		if($_POST['URL'] == NULL || $_POST['URL'] == "http://")
		{
			$feedback = "<div class='error'>No url given, enter a valid url please!</div>";
			$error = 1;
		}
		if($_POST['time'] == NULL)
		{
			$feedback = "<div class='error'>You did not select any option to advertise. Select one of the available advertising options</div>";
			$error = 1;
		}
		//we checked most of the stuff so put them in variables now
			$amount = mysqli_real_escape_string($link, $_POST['time']);
			$img = mysqli_real_escape_string($link, $_POST['Text']);
			
			$url = mysqli_real_escape_string($link, $_POST['URL']);
			$ip = mysqli_real_escape_string($link, $_POST['ip']);
			$date = time();
		//check if the image is not to big and if it has the right file extention
		list($width, $height, $type, $attr) = getimagesize($img);
		if($width > 125 || $height > 125)
		{
			$feedback = "<div class='error'>Your image is to large. the width and height of your image is ".$width."*".$height.". The allowed maximum size is 125*125.</div>";
			$error = 1;
		}
		if(($type != 1) && ($type != 2) && ($type != 3))
		{
			echo $type;
			$feedback = "<div class='error'>Wrong image type. Only gif, jpg and png are allowed file types</div>";
			$error = 1;
		}
		if($error == 0)
		{
			if($depositmoney->deposit >= $amount)
			{
				switch($amount)
				{
					case 5:
						$month = 1;
						$newdate = time()+60*60*24*30*$month;
					break;
					case 10:
						$month = 3;
						$newdate = time()+60*60*24*30*$month;
					break;
					case 20:
						$month = 6;
						$newdate = time()+60*60*24*30*$month;
					break;
					case 30:
						$month = 9;
						$newdate = time()+60*60*24*30*$month;
					break;
					case 40:
						$month = 12;
						$newdate = time()+60*60*24*30*$month;
					break;
				}
				//deduct the amount of his current balance
				$newamount = $depositmoney->deposit-$amount;
				mysqli_query($link, "UPDATE ".$usertable." SET deposit=".$newamount." WHERE ".$userid."=".$useridentify."");
				//add new advertisement
				mysqli_query($link, "INSERT INTO links (".$userid.", ip, date, Text, URL, status, endson) VALUES ('".$useridentify."', '".$ip."', '".$date."', '".$img."', '".$url."', '1', '".$newdate."')") or die ("can't insert new advertisement");
				$feedback = "<div class='succes'>Advertisement succesfully added!</div>";
			}//end of else check if the user still has enough money to advertise
			else
			{
				$feedback= "<div class='error'>You don't have enough money to extend your advertisement</div>";
			}
		}//end of if no errors
	}//end of if post ads_addvert was submitted
	?>
		<fieldset>
		<legend>Advertise on our site</legend>
			<?php 
			echo $feedback;
			echo $extend;
				?>
				<fieldset>
				<legend>Your current advertisements</legend>
				<?php
				$numadds = mysqli_num_rows($addsend);
				 if($numadds > 0)
				{
				?>
					<div class="table_wrapper">
						<table cellpadding="0" cellspacing="0">
						<tr>
								<th>Your image</th>
								<th>End's on</th>
								<th>extend</th>
							</tr>
						<?php
						//check if the user allready has a banner submitted so he can extend it if he wants.
						$adds = mysqli_query($link, "SELECT id, ".$userid.", endson, Text FROM links WHERE status=1 AND ".$userid."=".$useridentify."");
						while($result = mysqli_fetch_object($adds))
						{
							?>
							<tr>
								<td><img class="smalltutthumbnail" src="<?php echo $result->Text;?>" alt="your advertisement" title="your advertisement"/></td>
								<td><?php echo date("d M Y", $result->endson); ?></td>
								<td><a href="<?php echo $siteinfo->siteurl."ad_add.php?action=extend&amp;add=".$result->id.""; ?>">extend</a></td>
							</tr>
							<?php
						}//end of while
						?>
						</table>
					</div>
					<?php
				 }//end of if any adds in database
				 else
				 {
					?>
					You have no advertisement on our site. You can submit your advertisement below.
					<?php
				 }
				 ?>
				</fieldset>
			 <fieldset>
				<legend>Advertise</legend>
			 <p>Your current balance is <strong>$<?php echo $depositmoney->deposit; ?>.00</strong></p>
			 <?php
			 if($depositmoney->deposit >= 1)
			 {
				?>
					<p>
						<form method="post" action="<?php echo $siteinfo->siteurl; ?>ad_add.php" enctype="multipart/form-data">
						<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
						<p><label for="Text">Image </label><input type="text" name="Text" size="30" value="http://"/> <small>125*125</small></p>
						<p><label for="Text">URL </label> &nbsp;&nbsp;&nbsp;<input type="text" name="URL" size="30" value="http://"/></p>
						<p>For how long would you like to advertise?</p>
						 <?php
						if($depositmoney->deposit < 5)
						{
							$feedback = "<div class='error'>You don't have enough money on your account to advertise. 
							<a href='".$siteinfo->siteurl."/ad_add.php'>Click here</a> to deposit some money on your account</div>";
							$money = "disabled";
							$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";
						}
							echo "<p><input type='radio' name='time' id='time' ".$money." value='5'/> 1 Month / $5 ".$message."</p>";
						if($depositmoney->deposit < 10){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
							echo "<p><input type='radio' name='time' id='time' ".$money." value='10'/> 3 Month / $10 (save $5) ".$message."</p>";
						if($depositmoney->deposit < 20){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
							echo "<p><input type='radio' name='time' id='time' ".$money." value='20'/> 6 Month / $20 (save $10) ".$message."</p>";
						if($depositmoney->deposit < 30){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
							echo "<p><input type='radio' name='time' id='time' ".$money." value='30'/> 9 Month / $30 (save $15) ".$message."</p>";
						if($depositmoney->deposit < 40){$money = "disabled";$message = "<small><strong>Not enough money. <a href='".$siteinfo->siteurl."deposit.php'>Desposit money on your account</a></strong></small>";}
							echo "<p><input type='radio' name='time' id='time' ".$money."  value='40'/> 12 Month / $40 (save $20) ".$message."</p>";
						?>
						<p><input type="submit" name="ads_addvert" value="Advertise" /></p>
						</form>
					</p>
				<?php
			 }
			 else
			 {
				?>
				<p>You don't have enough money to advertise. <a href="<?php echo $siteinfo->siteurl; ?>deposit/">Click here</a> to deposit money on your account</p>
				<?php
			 }
			 ?>
			 </fieldset>
		</fieldset>
	<?php
}
else
{
	?>
	<span class="notlogin">You are not logged in, please login or register</span>
	<?php
}

#### INCLUDE FOOTER FILE OR CODE HERE#
//include("footer.php");
#INCLUDE FOOTER FILE OR CODE HERE#### 
?>