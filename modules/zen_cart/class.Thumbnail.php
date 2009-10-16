<?php

	class ThumbNailImage {
	
		function ThumbNailImage() {
	
			global $config;
	
		}
	
		function createthumb($input_file_name, $output_filename, $new_w, $new_h='') {
			if (preg_match("/(jpg|jpeg)$/i",$input_file_name)){
				$src_img = imagecreatefromjpeg($input_file_name);
			} else if (preg_match("/png$/i",$input_file_name)){
				$src_img = imagecreatefrompng($input_file_name);
			} else {
				print "ERROR: Cant work with file $input_file_name becuase its an unsupported file type for this function.";
			}
		
			if( $src_img == false ) {
				print "ERROR: Unabel to open image file $input_file_name";
			}
		
			$old_x = imageSX($src_img);
			$old_y = imageSY($src_img);
		
			if( $new_h == 0 ) {
				$thumb_w = $new_w;
						$thumb_h = $old_y * ($new_w / $old_x);
		
			} else if( $new_w == 0 ) {
				$thumb_h = $new_h;
						$thumb_w = $old_x * ($new_h / $old_y);
			} else {
				if ($old_x > $old_y) 	{
					$thumb_w = $new_w;
					$thumb_h = $old_y * ($new_h/$old_x);
				} else if ($old_x < $old_y) {
					$thumb_w = $old_x * ($new_w/$old_y);
					$thumb_h = $new_h;
				} else if ($old_x == $old_y) {
					$thumb_w = $new_w;
					$thumb_h = $new_h;
				}
			}
		
			$dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
		
			if (preg_match("/png$/i",$input_file_name)){
				imagepng($dst_img,$output_filename); 
			} else {
				imagejpeg($dst_img,$output_filename); 
			}
		
			imagedestroy($dst_img); 
			imagedestroy($src_img); 
		}
	
	}		

?>
