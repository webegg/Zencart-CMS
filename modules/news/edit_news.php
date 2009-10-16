<head>
<script type="text/javascript" src="../codelibrary/fckeditor/fckeditor.js"></script>
<script src="../js/script_tmt_validator.js" type="text/javascript"></script>
<script type="text/javascript" src="includes/fckeditor/fckeditor.js"></script>
<script language="javascript">
window.onload = function() 
{

	
	var sBasePath = "includes/fckeditor/";
	var oFCKeditor = new FCKeditor('content') ;
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
</head>
<?php 
	$db->select("webegg_com_au_$username");

	include("includes/fckeditor/fckeditor.php");
	
	$id = $_REQUEST['id'];
	if(isset($_POST['submit'])){ 
		@extract($_REQUEST);
		
		if ($id == '') { 
			$db->query("INSERT INTO inews (Title, News, Summary, published) VALUES ('$title', '$content', '$summary', '$published')");
			$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">News article successfully added!</strong></li>';
		} else {
		$db->query("UPDATE inews SET Title='$title', News='$content', Summary='$summary', published='$published' WHERE NewsID='$NewsID'");
		$update_message = '<li class="green"><span class="ico"></span><strong class="system_title">News article successfully updated!</strong></li>';
		}
	}
	
	$query = "SELECT * FROM inews WHERE inews.NewsID='$id'";
	$row = $db->getRow ( $query );

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
         News Article</h2>
        
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
                            <form action="<?=$_SERVER['PHP_SELF']?>" class="search_form general_form" method="post">
							<input type="hidden" name="_submit_check" value="1"/> 
							<input type="hidden" name="page" value="edit_news"/> 
							<input type="hidden" name="module" value="news"/> 
							<input type="hidden" name="id" value="<?php echo $row->NewsID?>" />
							<input type="hidden" name="NewsID" value="<?php echo $row->NewsID?>" />
                                <!--[if !IE]>start fieldset<![endif]-->
                                <fieldset>
                                    <!--[if !IE]>start forms<![endif]-->
                                    <div class="forms">
                                    <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Title:</label>
                                        <div class="inputs">
                                            <span class="input_wrapper"><input class="text" type="text" id="title" name="title" value="<?php echo $row->Title?>" size="50"/></span>
                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
                                    
                                     <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Summary:</label>
                                        <div class="inputs">
                                            <textarea name="summary" id="summary" cols="64" rows="6"><?php echo $row->Summary; ?></textarea>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									 <!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Content:</label>
                                        <div class="inputs">
                                           <?php  /*$ofckeditor = new fckeditor('content');
														$ofckeditor->BasePath = '../codelibrary/fckeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '600' ;
														$ofckeditor->Value = $content;
														$ofckeditor->Create();*/?><textarea name="content" rows="20" cols="50" class="txtfld"><?php echo $row->News;?></textarea>                                            
                                        </div>
                                    </div>
                                    <!--[if !IE]>end row<![endif]-->
									
									
									<!--[if !IE]>start row<![endif]-->
                                    <div class="row">
                                        <label>Published:</label>
                                        <div class="inputs">
											<input type="checkbox" name="published" value="1"<?php if ($row->published == '1') { ?> checked="checked" <?php } ?> />
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
