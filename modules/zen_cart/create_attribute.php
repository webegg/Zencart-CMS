<?
	$db->select("webegg_com_au_$username");
	
	$sqlqry		    = "SELECT * from products_description Where products_name!='' order by products_name asc";
	$getproducts	= $db->get_results($sqlqry);
	
	$sqlqry1		= "SELECT * from products_options order by products_options_name asc";
	$getoptions		= $db->get_results($sqlqry1);

	$sqlqry1			= "SELECT * from products_options_values ORDER BY CAST(products_options_values_name AS DECIMAL( 5 ) ) ";
	$getoptionvalues	= $db->get_results($sqlqry1);
	
	// Validate Option Name and Option Type Match
  function zen_validate_options_to_options_value($products_options_id, $products_options_values_id) {
    global $db;
    $check_options_to_values_query= $db->getRow("select count(*) as attributecnt
                                                  from products_options_values_to_products_options
                                                  where products_options_id= '" . $products_options_id . "'
                                                  and products_options_values_id='" . $products_options_values_id .
                                                  "' limit 1");

  	return $check_options_to_values_query->attributecnt;
  }

	
	function printArray($str) {
		print "<pre>";
			print_r($str);
		print "</pre>";	
	}
	
	$attribute_id = $_REQUEST["id"];
	
	if($_POST['products_id']!='' && $_POST['options_id']!='' && $_POST['options_values_id']!='') {
		extract($_REQUEST);

		$getattributecnt = zen_validate_options_to_options_value($options_id,$options_values_id);
		
		if($getattributecnt!=0)  {
			if($hdattributeid=='') {
				$db->query("INSERT INTO products_attributes (products_id,options_id,options_values_id,price_prefix,options_values_price,products_options_sort_order,
				product_attribute_is_free,products_attributes_weight,products_attributes_weight_prefix,
				attributes_display_only,attributes_default,attributes_discounted,attributes_price_base_included,attributes_price_onetime,attributes_price_factor,
				attributes_price_factor_offset,attributes_price_factor_onetime,attributes_price_factor_onetime_offset,attributes_qty_prices,attributes_qty_prices_onetime,
				attributes_price_words,attributes_price_words_free,attributes_price_letters,attributes_price_letters_free,attributes_required) 
	
				VALUES ('$products_id', '$options_id','$options_values_id','$price_prefix','$options_values_price','$products_options_sort_order',
				'$product_attribute_is_free','$products_attributes_weight','$products_attributes_weight_prefix',
				'$attributes_display_only','$attributes_default','$attributes_discounted','$attributes_price_base_included','$attributes_price_onetime','$attributes_price_factor',
				'$attributes_price_factor_offset','$attributes_price_factor_onetime','$attributes_price_factor_onetime_offset','$attributes_qty_prices','$attributes_qty_prices_onetime',
				'$attributes_price_words','$attributes_price_words_free','$attributes_price_letters','$attributes_price_letters_free','$attributes_required'
				)");
				$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Attributes successfully created!</strong></li>';
			} else {
				$db->query("UPDATE products_attributes SET products_id = '$products_id', options_id = '$options_id' , options_values_id='$options_values_id' ,price_prefix='$price_prefix' ,options_values_price='$options_values_price', products_options_sort_order='$products_options_sort_order',
				product_attribute_is_free ='$product_attribute_is_free', products_attributes_weight ='$products_attributes_weight', products_attributes_weight_prefix ='$products_attributes_weight_prefix',
				attributes_display_only = '$attributes_display_only', attributes_default='$attributes_default' , attributes_discounted= '$attributes_discounted', attributes_price_base_included='$attributes_price_base_included', attributes_price_onetime='$attributes_price_onetime',attributes_price_factor='$attributes_price_factor',
				attributes_price_factor_offset='$attributes_price_factor_offset', attributes_price_factor_onetime='$attributes_price_factor_onetime', attributes_price_factor_onetime_offset='$attributes_price_factor_onetime_offset' ,attributes_qty_prices = '$attributes_qty_prices' ,attributes_qty_prices_onetime='$attributes_qty_prices_onetime',
				attributes_price_words='$attributes_price_words',attributes_price_words_free='$attributes_price_words_free',attributes_price_letters='$attributes_price_letters',attributes_price_letters_free='$attributes_price_letters_free',attributes_required='$attributes_required'
				WHERE products_attributes_id ='$hdattributeid'");
				$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Attributes successfully updated!</strong></li>';
			}	
		} else {
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Attribute Option and Option Value Do NOT Match - Attribute was not added</strong></li>';
		}
	}
	
	if(!empty($attribute_id)) {
		$attribute_array = $db->get_results("Select A.*,B.products_name,C.products_options_name,D.products_options_values_name from products_attributes A, products_description B, products_options C, products_options_values D
		Where A.products_id = B.products_id and A.options_id = C.products_options_id and A.options_values_id = D.products_options_values_id and A.products_attributes_id='".$attribute_id."'");
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
         Product Attribute</h2>
        
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
								<input type="hidden" id="hdattributeid" name="hdattributeid" value="<?php echo $attribute_array[0]->products_attributes_id; ?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms" id="attributes">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Select Products:</label>
                                        <div class="inputs">
											<select name="products_id" id="products_id"> 
												<? for($k=0;$k<count($getproducts);$k++) { ?>
													<option value="<? echo $getproducts[$k]->products_id; ?>" <?php if($attribute_array[0]->products_id==$getproducts[$k]->products_id) { ?>selected="selected" <? } ?> >  <? echo $getproducts[$k]->products_name; ?></option>				
												<? } ?>									
											</select>                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Select Option Name :</label>
                                        <div class="inputs">
                                            <select name="options_id" id="options_id"> 
												<? for($m=0;$m<count($getoptions);$m++) { ?>
													<option value="<? echo $getoptions[$m]->products_options_id ; ?>" <?php if($attribute_array[0]->options_id==$getoptions[$m]->products_options_id) { ?>selected="selected" <? } ?>>  <? echo $getoptions[$m]->products_options_name ; ?></option>				
												<? } ?>									
											</select>                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row" >
                                        <label>Select Option Value :</label>
                                        <div class="inputs">
                                            <select name="options_values_id" id="options_values_id"> 
												<? for($z=0;$z<count($getoptionvalues);$z++) { ?>
													<option value="<? echo $getoptionvalues[$z]->products_options_values_id; ?>" <?php if($attribute_array[0]->options_values_id==$getoptionvalues[$z]->products_options_values_id) { ?>selected="selected" <? } ?> >  <? echo $getoptionvalues[$z]->products_options_values_name; ?></option>				
												<? } ?>									
											</select>
                                            
                                        </div>
                                    </div>
									
									<div class="row" >
                                        <label>Prices and Weights :</label>
                                        <div class="inputs" style="border:1px solid #cccccc; width:900px;">
											<div style="height:65px; width:900px;">
												<div style="float:left; width:140px;">
													<div class="arrtibutecontbox">Price</div>
													<div style="padding-left:5px;"><input type="text" name="price_prefix" id="price_prefix" size="2" <? if($attribute_id=='') {?> value="+" <? }?> value="<? echo $attribute_array[0]->price_prefix; ?>" /> &nbsp; <input type="text" name="options_values_price" id="options_values_price" size="6" value="<? echo $attribute_array[0]->options_values_price; ?>" /></div>
												</div>	
												<div style="float:left; width:140px;">
													<div class="arrtibutecontbox">Weight</div>
													<div><input type="text" name="products_attributes_weight_prefix" id="products_attributes_weight_prefix" size="2" <? if($attribute_id=='') {?> value="+" <? }?> value="<? echo $attribute_array[0]->products_attributes_weight_prefix; ?>" /> &nbsp; <input type="text" name="products_attributes_weight" id="products_attributes_weight" size="6" value="<? echo $attribute_array[0]->products_attributes_weight; ?>" /></div>
												</div>	
												<div style="float:left; width:70px;">
													<div class="arrtibutecontbox" style="width:50px;">Order</div>
													<div><input type="text" name="products_options_sort_order" id="products_options_sort_order" size="6" value="<? echo $attribute_array[0]->products_options_sort_order; ?>" /></div>
												</div>	
												<div style="float:left; width:70px;">
													<div class="arrtibutecontbox" style="width:50px;">One Time:</div>
													<div><input type="text" name="attributes_price_onetime" id="attributes_price_onetime" size="6" value="<? echo $attribute_array[0]->attributes_price_onetime; ?>" /></div>
												</div>	
												
												<div style="float:left; width:35px;">&nbsp;</div>
												
												<div style="float:left; width:70px;">
													<div class="arrtibutecontbox" style="width:70px;">Price Factor:</div>
													<div style="text-align:center"><input type="text" name="attributes_price_factor" id="attributes_price_factor" size="6" value="<? echo $attribute_array[0]->attributes_price_factor; ?>" /></div>
												</div>	
												<div style="float:left; width:70px;">
													<div class="arrtibutecontbox" style="width:70px;">Offset:</div>
													<div style="text-align:center"><input type="text" name="attributes_price_factor_offset" id="attributes_price_factor_offset" size="6" value="<? echo $attribute_array[0]->attributes_price_factor_offset; ?>" /></div>
												</div>	
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox" style="width:100px;">One Time Factor:</div>
													<div style="text-align:center"><input type="text" name="attributes_price_factor_onetime" id="attributes_price_factor_onetime" size="6" value="<? echo $attribute_array[0]->attributes_price_factor_onetime; ?>" /></div>
												</div>	
												<div style="float:left; width:70px;">
													<div class="arrtibutecontbox" style="width:70px;">Offset:</div>
													<div style="text-align:center"><input type="text" name="attributes_price_factor_onetime_offset" id="attributes_price_factor_onetime_offset" size="6" value="<? echo $attribute_array[0]->attributes_price_factor_onetime_offset; ?>" /></div>
												</div>	
											</div>	
											
											<div style="height:65px; width:900px;">
												<div style="float:left; width:420px;">
													<div class="arrtibutecontbox" style="width:420px;">Attributes Qty Price Discount:</div>
													<div style="text-align:center;"><input type="text" name="attributes_qty_prices" id="attributes_qty_prices" size="60" value="<? echo $attribute_array[0]->attributes_qty_prices; ?>" /></div>
												</div>	
												
												<div style="float:left; width:0	px;">&nbsp;</div>
												
												<div style="float:left; width:420px;">
													<div class="arrtibutecontbox" style="width:420px;">Onetime Attributes Qty Price Discount:</div>
													<div style="text-align:center;"><input type="text" name="attributes_qty_prices_onetime" id="attributes_qty_prices_onetime" size="60" value="<? echo $attribute_array[0]->attributes_qty_prices_onetime; ?>" /></div>
												</div>
											</div>
											
											<div style="height:65px; width:900px;">
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox">Price Per Word</div>
													<div style="padding-left:5px; text-align:center"><input type="text" name="attributes_price_words" id="attributes_price_words" size="6" value="<? echo $attribute_array[0]->attributes_price_words; ?>" /></div>
												</div>	
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox">Free Words</div>
													<div style="text-align:center;"><input type="text" name="attributes_price_words_free" id="attributes_price_words_free" size="6" value="<? echo $attribute_array[0]->attributes_price_words_free; ?>" /></div>
												</div>	
												<div style="float:left; width:0px;">&nbsp;</div>
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox">Price Per Letter:</div>
													<div style="padding-left:5px; text-align:center"><input type="text" name="attributes_price_letters" id="attributes_price_letters" size="6" value="<? echo $attribute_array[0]->attributes_price_letters; ?>" /></div>
												</div>	
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox">Free Letters</div>
													<div style="text-align:center;"><input type="text" name="attributes_price_letters_free" id="attributes_price_letters_free" size="6" value="<? echo $attribute_array[0]->attributes_price_letters_free; ?>" /></div>
												</div>	

											</div>
											
											<div style="height:90px; width:900px;">
												<div style="float:left; width:100px;">
													<div class="arrtibutecontbox" style="width:100px;">&nbsp;</div>
													<div style="text-align:center;" class="arrtibutecontbox" ><strong>Attribute Flags:</strong></div>
												</div>	
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Used For Display Purposes Only:</div>
													<div style="text-align:center;" class="arrtibutecontbox"><input name="attributes_display_only" value="0" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->attributes_display_only == '0') {  ?> checked="checked" <? } ?>  type="radio">
													&nbsp;No
													<input name="attributes_display_only" value="1" type="radio" <? if($attribute_array[0]->attributes_display_only == '1') {  ?> checked="checked" <? } ?>>
													&nbsp;Yes
													</div>
												</div>	
												
												<div style="float:left; width:10px;">&nbsp;</div>
												
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Attribute is Free When Product is Free:</div>
													<div style="text-align:center;" class="arrtibutecontbox">
													<input name="product_attribute_is_free" value="0" type="radio" <? if($attribute_array[0]->product_attribute_is_free == '0') {  ?> checked="checked" <? } ?>>
													&nbsp;No
													<input name="product_attribute_is_free" value="1" type="radio" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->product_attribute_is_free == '1') {  ?> checked="checked" <? } ?>>
													&nbsp;Yes
													</div>
												</div>	
												<div style="float:left; width:10px;">&nbsp;</div>
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Default Attribute to be Marked Selected:</div>
													<div style="text-align:center;" class="arrtibutecontbox">
													    <input name="attributes_default" value="0" type="radio" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->attributes_default == '0') {  ?> checked="checked" <? } ?>>
														&nbsp;No
														<input name="attributes_default" value="1" type="radio" <? if($attribute_array[0]->attributes_default == '1') {  ?> checked="checked" <? } ?>>
														&nbsp;Yes
													</div>
												</div>	
												
												<div style="float:left; width:10px;">&nbsp;</div>
												
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Apply Discounts Used by Product Special/Sale:</div>
													<div style="text-align:center;" class="arrtibutecontbox">
													    <input name="attributes_discounted" value="0" type="radio" <? if($attribute_array[0]->attributes_discounted == '0') {  ?> checked="checked" <? } ?>>
														&nbsp;No
														<input name="attributes_discounted" value="1" type="radio" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->attributes_discounted == '1') {  ?> checked="checked" <? } ?>>&nbsp;Yes
													</div>
												</div>	
												<div style="float:left; width:10px;">&nbsp;</div>
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Apply Discounts Used by Product Special/Sale:</div>
													<div style="text-align:center;" class="arrtibutecontbox">
													    <input name="attributes_price_base_included" value="0" type="radio" <? if($attribute_array[0]->attributes_price_base_included == '0') {  ?> checked="checked" <? } ?>>
														&nbsp;No
														<input name="attributes_price_base_included" value="1" type="radio" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->attributes_price_base_included == '1') {  ?> checked="checked" <? } ?>>
														&nbsp;Yes
													</div>
												</div>	
												<div style="float:left; width:10px;">&nbsp;</div>
												<div style="float:left; width:120px;">
													<div class="arrtibutecontbox" style="width:120px;">Apply Discounts Used by Product Special/Sale:</div>
													<div style="text-align:center;" class="arrtibutecontbox">
													    <input name="attributes_required" value="0" type="radio" <? if($attribute_id=='') {?> checked="checked" <? }?> <? if($attribute_array[0]->attributes_required == '0') {  ?> checked="checked" <? } ?>>
														&nbsp;No
														<input name="attributes_required" value="1" type="radio" <? if($attribute_array[0]->attributes_required == '1') {  ?> checked="checked" <? } ?>>
														&nbsp;Yes
													</div>
												</div>
											</div>
											
											

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
