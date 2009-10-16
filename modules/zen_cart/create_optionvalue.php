<?
	$db->select("webegg_com_au_$username");
	
	$sqlqry		    = "SELECT * from products_options order by products_options_name asc";
	$getoptionname 		= $db->get_results($sqlqry);
	
	function printArray($str) {
		print "<pre>";
			print_r($str);
		print "</pre>";	
	}
	
	$attribute_id = $_REQUEST["id"];
	
	if($_POST['products_options_values_name']!='') {
		extract($_REQUEST);
		
		if($hdattributeid=='') {
			$lastinsertid = $db->query("INSERT INTO products_options_values (products_options_values_name, products_options_values_sort_order) VALUES ('$products_options_values_name', '$products_options_values_sort_order')");
			$db->query("INSERT INTO products_options_values_to_products_options (products_options_id, products_options_values_id) VALUES ('$products_options_name', '$lastinsertid ')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Option value created succesfully!</strong></li>';
		
		} else {
			$db->query("UPDATE products_options_values SET products_options_values_name = '$products_options_values_name', products_options_values_sort_order = '$products_options_values_sort_order' WHERE products_options_values_id ='$hdattributeid'");
			$db->query("UPDATE products_options_values_to_products_options SET products_options_id = '$products_options_name' WHERE products_options_values_id ='$hdattributeid'");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Option value updated succesfully!</strong></li>';
		}	
	}
	
	if(!empty($attribute_id)) {
		$sqlqry		    = "SELECT * from products_options_values where products_options_values_id ='".$attribute_id."' ";
		$getoptions 	= $db->getRow($sqlqry);
		
		$sqlqry		    	= "SELECT A.products_options_values_to_products_options_id,B.products_options_id from products_options_values_to_products_options A,products_options B where A.products_options_id=B.products_options_id and A.products_options_values_id ='".$attribute_id."' ";
		$getoptiondeails 	= $db->getRow($sqlqry);
		
	}


?>

<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>
        <?php
     if ($id == !'') { ?>
         Edit
     <?php } else { ?>
		 Add New
	<?php  } ?>
         Option Value</h2>
        
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
                            <form action="" class="search_form general_form" method="post">
								<input type="hidden" id="hdattributeid" name="hdattributeid" value="<?php echo $getoptions->products_options_values_id; ?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms" id="attributes">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Option Name:</label>
                                        <div class="inputs">
												<select name="products_options_name" id="products_options_name">
												<? for($k=0;$k<count($getoptionname);$k++) { ?>
													<option value="<? echo $getoptionname[$k]->products_options_id; ?>" <?php if($getoptiondeails->products_options_id==$getoptionname[$k]->products_options_id) { ?>selected="selected" <? } ?> >  <? echo $getoptionname[$k]->products_options_name ; ?></option>				
												<? } ?>									
											</select>
											
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Option Value :</label>
                                        <div class="inputs">
                                           <input class="text" type="text" id="products_options_values_name" name="products_options_values_name" value="<?php echo $getoptions->products_options_values_name?>" size="25"/>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Sort Order:</label>
                                        <div class="inputs">
                                           <select name="products_options_values_sort_order" id="products_options_values_sort_order">
										   	 <?php for($j=1;$j<=20;$j++) { ?>
												<option value="<?php echo $j; ?>" <?php if($j==$getoptions->products_options_values_sort_order) { ?> selected="selected" <? } ?>><? echo $j;?></option>
											<?php  } ?>	
											</select>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->							
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <div class="buttons" style="padding-left:200px;">
                                            
                                            
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