<head>
<script type="text/javascript" src="../codelibrary/fckeditor/fckeditor.js"></script>
<script src="../js/script_tmt_validator.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/fckeditor/fckeditor.js"></script>
<script language="javascript">
window.onload = function() 
{

	
	var sBasePath = "includes/fckeditor/";
	var oFCKeditor = new FCKeditor('products_description') ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;
	oFCKeditor.width=500;
	oFCKeditor.height=600;

	
}
</script>
<script type="text/javascript" src="../js/func.js"></script>
 <script>
  function validate(obj)
   {
    if(obj.content.value=='')
   {
   alert('Please Enter Content');
   return false;
  }else{
   return true;
  }
 }
 

</script>
<script type="text/javascript" src="js/tabber.js"></script>
<link rel="stylesheet" href="css/tabber.css" TYPE="text/css" MEDIA="screen">
<script type="text/javascript">

/* Optional: Temporarily hide the "tabber" class so it does not "flash"
   on the page as plain HTML. After tabber runs, the class is changed
   to "tabberlive" and it will appear. */

document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>

<script type="text/javascript">
 function removeimage(proid) {
 	if (confirm("Are you sure you want to delete this image")) {
		document.getElementById("removeimageid").value = proid;
		document.getElementById("removeimage").value = 1;
		document.addproduct.submit();
		return true;
	} else {
		return false;
	}	
 }
 </script>

</head>
<?php 

	set_time_limit(-1);
	ini_set('memory_limit', '1024M');

	include("includes/fckeditor/fckeditor.php");
	
	$localpath = $_SERVER['DOCUMENT_ROOT'].'/myegg/images/';	
		
	$db->select("webegg_com_au_global");
	
	$sqlqry		= "SELECT * from users where ID = '".$_SESSION['user_id']."'";
	$getusers 	= $db->getRow ($sqlqry);
	
	$ftp_server		=	$getusers->ftp_server;
	$ftp_user_name	=	$getusers->ftp_user_name;
	$ftp_user_pass	=	$getusers->ftp_user_pass;

	
	$id = $_REQUEST['id'];
	
	$db->select("webegg_com_au_$username");

	if($_POST['removeimage']==1) {
		$product_id 	= $_POST["removeimageid"];
		$sqlqry		    = "SELECT products_image from products where products_id='$product_id'";
		$images 		= $db->getRow ($sqlqry);
		$products_image = $images->products_image;
		$originalpath	= $localpath.$products_image;
		
		if($products_image) {
			unlink($originalpath);
		}
		
		$conn	      = ftp_connect($ftp_server);
		$login_result = ftp_login($conn, $ftp_user_name, $ftp_user_pass);
		
		$delefile 	 = '/var/www/html/beta/shop/images/'.$products_image;
		
		ftp_delete($conn,$delefile);
		
		ftp_close($conn);
		
		$db->query("UPDATE products SET products_image = '' WHERE products_id='$product_id'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Image removed succesfully!</strong></li>';
	}
	
	if(isset($_POST['addpro'])){ 
	@extract($_REQUEST);
	
	
	// BOF Addition image upload ****
		if($_FILES['additional_image']['size'] > 0) {
			$sqlqry = "SELECT categories_name from categories_description where categories_id='$master_categories_id'";
			$datas = $db->getRow ($sqlqry);
			$category_name  = $datas->categories_name;
			
			$imagepath = $localpath.$category_name.'/';
			
			if(!file_exists($imagepath) ) {
				mkdir($imagepath, 0777);
				chmod($imagepath, 0777);
			}
			$tmpflname = 'thumb_'.time().'_'.$_FILES['additional_image']['name'];
			$timestampflname = time().'_'.$_FILES['additional_image']['name'];
			
			$filename = $imagepath.$timestampflname;
			$additional_filename = 'images/'.$category_name.'/'.$tmpflname;
			$db->query("INSERT INTO additional_images (prod_id, image) VALUES ('$id', '$additional_filename')");

				copy($_FILES['additional_image']['tmp_name'],$filename);
				
				/* image resize */
					require_once("class.Thumbnail.php");
					$objThumbnail = new ThumbNailImage();
					$thumbfilename = $imagepath.'thumb_'.$timestampflname;
					$photoext = $_FILES['additional_image']['name'];
					$objThumbnail->createthumb($filename,$thumbfilename,NULL,"640");
				/* end */

				$entryfilename = $category_name.'/'.'thumb_'.$timestampflname;
				$name 		  = 'thumb_'.$timestampflname;

				
				/* copy the Image from Server to Server*/
				
				$src_path 	 =  $thumbfilename;
				$dirname 	 = '/var/www/html/beta/shop/images/'.$category_name.'/';
				$dest_path   = $dirname.$name;
				
			
				// set up basic connection
				$conn_id = ftp_connect($ftp_server);
				
				// login with username and passwordss
				$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
				
				// create directory
				if(!file_exists($dirname))
					ftp_mkdir($conn_id, $dirname);
				
				// set the permission
				//ftp_chmod($conn_id, 0777, $dirname);
				
				// upload a file
				ftp_put($conn_id, $dest_path, $src_path, FTP_ASCII);
				
				// close the connection
				ftp_close($conn_id);
				
				/* copy the Image from Server to Server*/
				

			 
		}
		//EOF Addition Image Upload
		
		if($_FILES['products_image']['size'] > 0) {
			$sqlqry = "SELECT categories_name from categories_description where categories_id='$master_categories_id'";
			$datas = $db->getRow ($sqlqry);
			$category_name  = $datas->categories_name;
			
			$imagepath = $localpath.$category_name.'/';
			
			if(!file_exists($imagepath) ) {
				mkdir($imagepath, 0777);
				chmod($imagepath, 0777);
			}
			
			$timestampflname = time().'_'.$_FILES['products_image']['name'];
			
			$filename = $imagepath.$timestampflname;
			
			if($filename) {
				/* Unlink the images */
				if ($id != '') { 
					$sqlqry		    = "SELECT products_image from products where products_id='$id'";
					$images 		= $db->getRow ($sqlqry);
					$products_image = $images->products_image;
					$originalpath	= $localpath.$products_image;
					/*if($products_image) {
						unlink($originalpath);
					}*/
				}	
				copy($_FILES['products_image']['tmp_name'],$filename);
				
				/* image resize */
					require_once("class.Thumbnail.php");
					$objThumbnail = new ThumbNailImage();
					$thumbfilename = $imagepath.'thumb_'.$timestampflname;
					$photoext = $_FILES['products_image']['name'];
					$objThumbnail->createthumb($filename,$thumbfilename,NULL,"640");
				/* end */

				$entryfilename = $category_name.'/'.'thumb_'.$timestampflname;
				$name 		  = 'thumb_'.$timestampflname;

				
				/* copy the Image from Server to Server*/
				
				$src_path 	 =  $thumbfilename;
				$dirname 	 = '/var/www/html/beta/shop/images/'.$category_name.'/';
				$dest_path   = $dirname.$name;
				
			
				// set up basic connection
				$conn_id = ftp_connect($ftp_server);
				
				// login with username and passwordss
				$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
				
				// create directory
				if(!file_exists($dirname))
					ftp_mkdir($conn_id, $dirname);
				
				// set the permission
				//ftp_chmod($conn_id, 0777, $dirname);
				
				// upload a file
				ftp_put($conn_id, $dest_path, $src_path, FTP_ASCII);
				
				// close the connection
				ftp_close($conn_id);
				
				/* copy the Image from Server to Server*/
				
				if($entryfilename!='' && $id!='')
					$db->query("UPDATE products SET products_image = '$entryfilename' WHERE products_id='$product_id'");
			} 
		}
		

		if ($id == '') { 
			$db->query("INSERT INTO products (products_type, products_quantity, products_image, products_price, products_date_added, products_last_modified, products_weight, products_status, manufacturers_id, product_is_free, product_is_call, master_categories_id) VALUES ('1', '1000000000', '$entryfilename', '$products_price', 'NOW', 'NOW', '0', '$products_status', '$manufacturers_id', '$product_is_free', '$product_is_call', '$master_categories_id')");
			$products_id = $db->get_var("SELECT products_id FROM products WHERE products_id = LAST_INSERT_ID()");
			$db->query("INSERT INTO products_description (language_id, products_name, products_description) VALUES ('1', '$products_name', '$products_description')");
			$db->query("INSERT INTO products_to_categories (products_id, categories_id) VALUES ('$products_id', '$master_categories_id')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Product successfully created!</strong></li>';
		} else {
			$db->query("UPDATE products SET products_price = '$products_price', products_last_modified = 'NOW', products_weight = '$products_weight', products_status = '$products_status', manufacturers_id = '$manufacturers_id', product_is_free = '$product_is_free', product_is_call = '$product_is_call', master_categories_id = '$master_categories_id' WHERE products_id='$product_id'");
			$db->query("UPDATE products_description SET products_name = '$products_name', products_description = '$products_description' WHERE products_id='$product_id'");
			$db->query("UPDATE products_to_categories SET categories_id = '$master_categories_id' WHERE products_id='$product_id'");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">Product successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM products LEFT JOIN products_description on (products.products_id = products_description.products_id) LEFT JOIN categories_description on (products.master_categories_id = categories_description.categories_id) LEFT JOIN manufacturers on (products.manufacturers_id = manufacturers.manufacturers_id) WHERE products.products_id='$id'";
	$row = $db->getRow ( $query );

?>
<?php
//Get current URL
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

//BOF Remove additional image
if($_GET['imgid'] != '') {
	$tmpid = $_GET['imgid'];
	$query = "DELETE FROM additional_images WHERE id = $tmpid";
	mysql_query($query);
}

?>

 <form action="<?=$_SERVER['PHP_SELF']?>" class="search_form general_form" name="addproduct" id="addproduct" method="post" enctype="multipart/form-data">
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
         Shop Product</h2>
        
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

                              <!--[if !IE]>start forms<![endif]-->
							<ul class="system_messages">
								<?php echo "$update_message"; ?>
							</ul>
                           
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="edit_product"/>
							<input type="hidden" name="module" value="zen_cart"/> 
							<input type="hidden" name="id" value="<?php echo $row->products_id?>" />
							<input type="hidden" name="product_id" value="<?php echo $row->products_id?>" />
							<input type="hidden" name="removeimageid" id="removeimageid" value="" />
							<input type="hidden" name="removeimage" id="removeimage" value="" />
                        
                          
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    
                                    <div class="tabber">
                                    
                                         <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>General</h2>
                                            <p>
                                                <label>Product Name:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="products_name" name="products_name" value="<?php echo $row->products_name?>" size="50"/>
                                                    </span>  
                                                    <br />
													<label>Content:</label>
                                       
                                           <?php  /*$ofckeditor = new fckeditor('products_description');
														$ofckeditor->BasePath = 'includes/fckeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '600' ;
														$ofckeditor->Value = $products_description;
														$ofckeditor->Create();*/?><textarea name="products_description" rows="20" cols="50" class="txtfld"><?php echo $row->products_description;?></textarea>                                            
                                        
													<br />
                                                      <label>Active:</label>

                                            <select name="products_status" id="products_status">
						<?php if ($row->products_status == '1') { ?>
							<option value="1">Yes</option>
						<?php } ?>
						<option value="0">No</option>
						<option value="1">Yes</option>
						</select>
											<br />
                                                      <label>Product is Free:</label>

                                            <input type="radio" id="product_is_free" name="product_is_free" <?php if ($row->product_is_free == '1') { ?> checked="checked"<?php } ?> value="1" />
											<br />
                                                      <label>Call for Price:</label>

                                            <input type="radio" id="product_is_call" name="product_is_call" <?php if ($row->product_is_call == '1') { ?> checked="checked"<?php } ?> value="1" />
                                            </p>
                                            <div style="height:10px;"></div>
                                         </div>
                                    
                                    
                                         <div class="tabbertab">
											<div style="height:10px;"></div>
                                          <h2>Pricing</h2>
                                          <p>
                                                <label>Price:</label>
                                                
                                                    <span class="input_wrapper">
                                                        <input class="text" type="text" id="products_price" name="products_price" value="<?php echo $row->products_price?>" size="50"/>
                                                    </span>  
                                                    <br />
										  
										  </p>
                                         </div>
                                    	
                                         <div class="tabbertab">
										 <div style="height:10px;"></div>
                                          <h2>Category / Manufacturer</h2>
                                          <p>
										  <label>Manufacturer:</label>
                                                <select name="manufacturers_id">
												<option value="<?php echo $row->manufacturers_id?>"><?php echo $row->manufacturers_name; ?></option>
                                                    
										  <?php If ( $manufacturers= $db->get_results("SELECT * FROM manufacturers") ) {
                                            foreach( $manufacturers as $manufacturers )
                                            { ?>
											<option value="<?php echo $manufacturers->manufacturers_id?>"><?php echo $manufacturers->manufacturers_name; ?></option>
											<?php } } else { ?>No Manufacturers in Database <?php } ?>
											</select>
											<br />
											
										  <label>Category:</label>
                                                <select name="master_categories_id">
												<option value="<?php echo $row->master_categories_id?>"><?php echo $row->categories_name; ?></option>
                                                    
										  <?php If ( $categories = $db->get_results("SELECT * FROM categories LEFT JOIN categories_description on (categories.categories_id = categories_description.categories_id)") ) {
                                            foreach( $categories as $categories )
                                            { ?>
											<option value="<?php echo $categories->categories_id?>"><?php echo $categories->categories_name; ?></option>
											<?php } } else { ?>No categories in Database <?php } ?>
											</select>
										  </p>
                                         </div>
										 <div class="tabbertab">
                                          <div style="height:10px;"></div>
                                          <h2>Attributes</h2>
                                            <p>
											<?php If ( $attributes = $db->get_results("SELECT * FROM products_attributes LEFT JOIN products_options on (products_attributes.options_id = products_options.products_options_id) LEFT JOIN products_options_values on (products_attributes.options_values_id = products_options_values.products_options_values_id) WHERE products_attributes.products_id = '$id' ORDER BY products_options.products_options_name ") ) { ?>
											<b>Current Attributes</b>
                                            
											<?php foreach( $attributes as $attributes )
                                            { ?>
											
													<li><?php echo $attributes->products_options_name ?>: <?php echo $attributes->products_options_values_name; ?></li>
												
											<?php } } else { ?>There are currently no attributes for this product <?php } ?>	
											<br />
											<a href="#" onclick="window.open('default_content.php?page=create_attribute&module=zen_cart&id=<?php echo $product_id; ?>', 'StatusBar', 'toolbar=no,resizable=yes,scrollbars=yes,width=800,height=600,left=200,top=200');" title=""><span class="button send_form_btn"><span><span>Add Attribute</span></span></span></a>
											<br /><br />
											<b><i>Note:</b> Added attributes will display when page is refreshed.</i>
                                            
                                        
											
											</p>
										</div>
										
										<div class="tabbertab">

											<div style="height:10px;"></div>
                                          <h2>Images</h2>
                                          <p>
										  		<? if($row->products_image!='') { ?>
	                                             <label>Change Image:</label>
												 <? } else { ?>
												 <label>Upload Image:</label>
												 <? } ?>
                                                
												<span >
													<input type="file" name="products_image" size="25" />
												</span><br />
			<? if($row->products_image!='') { ?>
			<label>Add&nbsp;Image:</label>
			<span >
													<input type="file" name="additional_image" size="25" />
												</span>
			<? } ?>
												<? if($row->products_image!='') { ?>
												<span style="padding-left:150px;" >
													<img width="60" height="60" src="images/<? echo $row->products_image; ?>" border="0"  align="texttop" />
													

													<br />
													<span style="color:#0000FF; padding-left:520px; cursor:pointer; text-decoration:underline;" onclick="removeimage('<?php echo $row->products_id?>');">Remove</a> </span>
													

												</span>
												<? } ?>
											
												<br />
<div style="white-space:none;">		Additional Images <br />							<?
$id = $_GET['id'];
$query = "SELECT * FROM additional_images WHERE `prod_id` = $id";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)) {
?>
<div style="display:inline; float:left; margin-right:10px;">
		<?	echo '<img src="'.$row['image'].'" width="100" max-height=auto>';?>
		<br />
<a href="<?= curPageURL(); ?>&imgid=<?=$row['id']?>">Remove</a>
</div>
<?
}
?>
<div style="clear:both;"></div>
</div>													
										  
										  </p>
                                         </div>
                                    
                                    </div>
                                    
                       			            
                                   <div style="height:20px;"></div>
															
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <div class="buttons">
                                            
                                            
                                            <ul>
                                                <li><span class="button send_form_btn"><span><span>SUBMIT</span></span><input name="addpro" type="submit" /></span></li>
                                                <li><span class="button cancel_btn"><span><span>CANCEL</span></span><input name="" onclick="javascript:history.back()" /></span></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    </div>
                                    <!--[if !IE]>end forms<![endif]-->
                                </fieldset>
                                <!--[if !IE]>end fieldset<![endif]-->
                            
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
</form>