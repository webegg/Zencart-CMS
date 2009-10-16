<?php
	include "../../settings.php";
	$id = $_REQUEST['id'];
	$username  = $_REQUEST['username'];
	
	$db->select("webegg_com_au_$username");
	
	if(isset($_POST['submit'])){ 
	@extract($_REQUEST);

		if($_FILES['image']['size']>0)
			{
				$image1=time().$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'../images/categories/'.$image1);
				@resize_img("../images/categories/".$image1, 100, '75', false, 80, 0, "");	
			}
		
		
		if ($id == '') { 
			$db->query("INSERT INTO products (products_type, products_quantity, products_image, products_price, products_date_added, products_last_modified, products_weight, products_status, manufacturers_id, product_is_free, product_is_call, master_categories_id) VALUES ('1', '1000000000', '$image1', '$products_price', 'NOW', 'NOW', '0', '$products_status', '$manufacturers_id', '$product_is_free', '$product_is_call', '$master_categories_id')");
			$products_id = $db->get_var("SELECT products_id FROM products WHERE products_id = LAST_INSERT_ID()");
			$db->query("INSERT INTO products_description (language_id, products_name, products_description) VALUES ('1', '$products_name', '$products_description')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Product successfully created!</strong></li>';
		} else {
		$db->query("UPDATE products SET products_price = '$products_price', products_last_modified = 'NOW', products_weight = '$products_weight', products_status = '$products_status', manufacturers_id = '$manufacturers_id', product_is_free = '$product_is_free', product_is_call = '$product_is_call', master_categories_id = '$master_categories_id' WHERE products_id='$product_id'");
		$db->query("UPDATE products_description SET products_name = '$products_name', products_description = '$products_description' WHERE products_id='$product_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Product successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM products LEFT JOIN products_description on (products.products_id = products_description.products_id) WHERE products.products_id='$id'";
	$row = $db->getRow ( $query );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<title>Administration Panel</title>
<link media="screen" rel="stylesheet" type="text/css" href="../../css/admin.css"  />
<!--[if lte IE 6]><link media="screen" rel="stylesheet" type="text/css" href="css/admin-ie.css" /><![endif]-->
</head>
<body>
<!--[if !IE]>start section<![endif]-->	
<div class="section">
    <!--[if !IE]>start title wrapper<![endif]-->
    <div class="title_wrapper">
        <h2>Add Attribute</h2>
        
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
							<b>Product:</b> <?php echo $row->products_name; ?>
							<br /><br />
								<div style="width:300px; position:relative; float:left;">
							<?php If ( $attributes = $db->get_results("SELECT * FROM products_options LEFT JOIN products_options_values_to_products_options on (products_options.products_options_id = products_options_values_to_products_options.products_options_values_id) LEFT JOIN products_options_values on(products_options_values_to_products_options.products_options_values_to_products_options_id = products_options_values.products_options_values_id) ORDER BY products_options.products_options_name ") ) {
								foreach( $attributes as $attributes )
								{ ?>
								<div style="position:relative; float:left; width:100px"><input type="radio" name="options_values_id" value="<?php echo $attributes->products_options_values_id ?>" /> <?php echo $attributes->products_options_values_name; ?></div>
								<?php } } else { ?>There are currently no attributes in the database <?php } ?>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>