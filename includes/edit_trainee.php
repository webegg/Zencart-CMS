<?php 
	$id = $_REQUEST['id'];
	if(isset($_POST['submit'])){ 
			$trainee_id = $_REQUEST['trainee_id'];
			$f_name = $_REQUEST['f_name'];
			$s_name = $_REQUEST['s_name'];
			$employer_id = $_REQUEST['employer'];
			$trade_id = $_REQUEST['trade'];
			$street = $_REQUEST['street'];
			$suburb = $_REQUEST['suburb'];
			$state = $_REQUEST['state'];
			$postcode = $_REQUEST['postcode'];
			$phone = $_REQUEST['phone'];
			$union_number = $_REQUEST['union_number'];
			$fin_union = $_REQUEST['fin_union'];
			$payment_1 = $_REQUEST['payment_1'];
			$payment_2 = $_REQUEST['payment_2'];
			$payment_3 = $_REQUEST['payment_3'];
			$payrise_1 = $_REQUEST['payrise_1'];
			$payrise_2 = $_REQUEST['payrise_2'];
			$payrise_3 = $_REQUEST['payrise_3'];
			$payrise_4 = $_REQUEST['payrise_4'];
			$tools = $_REQUEST['tools'];
			$clothes = $_REQUEST['clothes'];
			$clothes_2 = $_REQUEST['clothes_2'];
			$status = $_REQUEST['status'];
		
		if ($id == '') { 
			$db->query("INSERT INTO trainees (trainee_fname, trainee_sname, employer_id, trade_id, street, suburb, state, postcode, phone, union_number, fin_union, payment_1, payment_2, payment_3, payrise_1, payrise_2, payrise_3, payrise_4, tools, clothes, clothes_2, status) VALUES ('$f_name', '$s_name', '$employer', '$trade', '$street', '$suburb', '$state', '$postcode', '$phone', '$union_number', '$fin_union', '$payment_1', '$payment_2', '$payment_3', '$payrise_1', '$payrise_2', '$payrise_3', '$payrise_4', '$tools', '$clothes', '$clothes_2', '$status')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Trainee successfully added!</strong></li>';
		} else {
		$db->query("UPDATE trainees SET trainee_fname='$f_name', trainee_sname='$s_name', employer_id='$employer_id', trade_id='$trade_id', street='$street', suburb='$suburb', state='$state', postcode='$postcode', phone='$phone', union_number='$union_number', fin_union='$fin_union', payment_1='$payment_1', payment_2='$payment_2', payment_3='$payment_3', payrise_1='$payrise_1', payrise_2='$payrise_2', payrise_3='$payrise_3', payrise_4='$payrise_4', tools='$tools', clothes='$clothes', clothes_2='$clothes_2', status='$status' WHERE trainee_id='$trainee_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Trainee successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM trainees WHERE trainees.trainee_id='$id'";
	$row = $db->getRow ( $query );
	$employer_id = $row->employer_id;
	$query2 = "SELECT * FROM employers WHERE employer_id='$employer_id'";
	$row2 = $db->getRow ( $query2 );
	$trade_id = $row->trade_id;
	$query3 = "SELECT * FROM trades WHERE trade_id='$trade_id'";
	$row3 = $db->getRow ( $query3 );
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
         Trainee</h2>
        
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
							<input type="hidden" name="page" value="edit_trainee"/> 
							<input type="hidden" name="id" value="<?php echo $row->trainee_id?>" />
							<input type="hidden" name="trainee_id" value="<?php echo $row->trainee_id?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>First Name:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="f_name" name="f_name" value="<?php echo $row->trainee_fname?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Last Name:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="s_name" name="s_name" value="<?php echo $row->trainee_sname?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Employer:</label>
                                        <div class="inputs">
                                            <?php $user = $db->get_results("SELECT * FROM employers"); ?>
											<select name="employer">
												<option value="<?php echo $row2->employer_id?>"><?php echo $row2->employer_name?></option>
												<?php foreach ($user as $user) { ?>
												<option value="<?php echo $user->employer_id ?>"><?php echo $user->employer_name ?></option>
												<?php } ?>
											</select>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Trade:</label>
                                        <div class="inputs">
                                            <?php $user2 = $db->get_results("SELECT * FROM trades"); ?>
											<select name="trade">
													<option value="<?php echo $row3->trade_id?>"><?php echo $row3->trade_name?></option>
													<?php foreach ($user2 as $user2) { ?>
													<option value="<?php echo $user2->trade_id ?>"><?php echo $user2->trade_name ?></option>
													<?php } ?>
												</select>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Street:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="street" name="street" value="<?php echo $row->street ?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Street:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="suburb" name="suburb" value="<?php echo $row->suburb?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>State:</label>
                                        <div class="inputs">
                                            <select name="state"><option value="<?php echo $row->state?>"><?php echo $row->state;?></option><option value="QLD">QLD</option><option value="NSW">NSW</option><option value="VIC">VIC</option><option value="ACT">ACT</option><option value="SA">SA</option><option value="NT">NT</option><option value="WA">WA</option></select>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Postcode:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="postcode" name="postcode" value="<?php echo $row->postcode?>" size="10"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Phone:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="phone" name="phone" value="<?php echo $row->phone?>" size="20"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->						
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Union Number:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="union_number" name="union_number" value="<?php echo $row->union_number?>" size="20"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Fin. Union Member:</label>
                                        <div class="inputs">
                                            <input type="checkbox" name="fin_union" value="1"<?php if ($row->fin_union == '1') { ?> checked="checked" <?php } ?> />
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Payments:</label>
                                        <div class="inputs">
                                            1: <input type="checkbox" name="payment_1" value="1"<?php if ($row->payment_1 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
									        2: <input type="checkbox" name="payment_2" value="1"<?php if ($row->payment_2 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
									        3: <input type="checkbox" name="payment_3" value="1"<?php if ($row->payment_3 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Payrises:</label>
                                        <div class="inputs">
											1: <input type="checkbox" name="payrise_1" value="1"<?php if ($row->payrise_1 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
											2: <input type="checkbox" name="payrise_2" value="1"<?php if ($row->payrise_2 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
											3: <input type="checkbox" name="payrise_3" value="1" <?php if ($row->payrise_3 == '1') { ?> checked="checked" <?php } ?>/>&nbsp;&nbsp;
											4: <input type="checkbox" name="payrise_4" value="1"<?php if ($row->payrise_4 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Tools Allowance:</label>
                                        <div class="inputs">
											<input type="checkbox" name="tools" value="1"<?php if ($row->tools == '1') { ?> checked="checked" <?php } ?> />
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Clothes:</label>
                                        <div class="inputs">
											1: <input type="checkbox" name="clothes" value="1"<?php if ($row->clothes == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
									        2: <input type="checkbox" name="clothes_2" value="1"<?php if ($row->clothes_2 == '1') { ?> checked="checked" <?php } ?> />&nbsp;&nbsp;
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Status:</label>
                                        <div class="inputs">
											<select name="status">
												<option value="<?php echo $row->status?>"><?php echo $row->status?></option>
												<option value="Active">Active</option>
												<option value="Completed">Completed</option>
												<option value="Drop Out">Drop Out</option>
											</select>
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
