
 <div class="title_wrapper">
        <h2>Select Contacts</h2>
        <span class="title_wrapper_left"></span>
        <span class="title_wrapper_right"></span>
    </div>
<div class="section_content">
        <!--[if !IE]>start section content top<![endif]-->
        <div class="sct">
            <div class="sct_left">
                <div class="sct_right">
                    <div class="sct_left">
                        <div class="sct_right">
                            
                        
                            <fieldset style="border:none">
                            <!--[if !IE]>start table_wrapper<![endif]-->
                            <div class="table_wrapper">
                                <div class="table_wrapper_inner">
								<?php
	if(mysql_num_rows($sql) != 0)
	{
		?>
		<!--<p><a href="<?php echo $site_http; ?>modules/user_account/deposit/pdfgenerator.php?user_id=<?php echo $user_id; ?>" target="_blank">Generate complete deposit history in PDF</a></p>-->
		 <table cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr>
				<th>Invoice #.</th>
				<th width="80%">Amount</th>
				<th style="width: 96px;">Actions</th>
			</tr>
		<?php
		while($result = mysql_fetch_object($sql))
		{
			?>
			<tr class="first">               
				  <td><?php echo $result->unique_code; ?></td>
				<td><?php echo $result->amount; ?></td>
				  <td>
					<div class="actions">
						<a href="<?php echo $site_http; ?>modules/user_account/deposit/pdfgenerator.php?deposit=<?php echo $result->id; ?>" target="_blank">Generate PDF</a></li>
							
						
					</div>
				</td>
			</tr>
			<?php
		}//end of while any history
		?>
		</table>
		<?php
	}//end of if any history of that user
	else
	{
		?>
		<p>You have no deposit history.</p>
		<?php
	}//end of else if any history of that user
	?>
</fieldset>
<?php
}
else
{
	?>
	<span class="notlogin">You are not logged in, please login or register</span>
	<?php } ?>
								</div>
								</div></div></div></div></div>
								<!--[if !IE]>start section content bottom<![endif]-->
        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
        <!--[if !IE]>end section content bottom<![endif]-->
	
					
					
					
				</div>
				
			</div>
			<!--[if !IE]>end page<![endif]-->
			<!--[if !IE]>start sidebar<![endif]-->
			<div id="sidebar">
				<div class="inner">
					<div class="quick_info">
    <div class="quick_info_top">
        <h2>Account Overview</h2>
    </div>
	 <form name="depositform" id="depositform" method="post" action="<? echo $paypalaction; ?>">
	<input type="hidden" name="rm" value="2"/>
	<input type="hidden" name="cmd" value="_xclick"/>
	<input type="hidden" name="business" value="<?php echo $paypal_email; ?>"/>
	<input type="hidden" name="item_name" value="Deposit cash"/>
	<input type="hidden" name="no_shipping" value="1"/>
	<input type="hidden" name="return" value="http://www.webegg.com.au/myegg/modules/user_account/deposit/deposit_history.php?action=success"/>
	<input type="hidden" name="notify_url" value="http://www.webegg.com.au/myegg/modules/user_account/deposit/depositipn.php"/>
	<input type="hidden" name="cancel_return" value="http://www.webegg.com.au/myegg/modules/user_account/deposit/deposit_history.php?action=cancel"/>
	<input type="hidden" name="custom" value="<?php echo $user_id; ?>" />
	<input type="hidden" name="currency_code" value="<?php echo $paypal_currency_code; ?>">
	<input type="hidden" name="lc" value="<?php echo $paypal_location;?>">

    <div class="quick_info_content" align="center">
		Your account balance is<br />
		<span style="font-size:20px; font-weight:bold">$<?php echo $cb->deposit; ?></span>
		<br /><Br />
		<span style="color:#FF0000; font-weight:bold; font-style:italic"><?php echo $feedback; ?></span><br />
		Make a Deposit<br />
		<b>Deposit Value ($):</b><br /><input type="text" name="amount" size="10" /><br />
				
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


