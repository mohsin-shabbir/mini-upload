<?php
function createthumb($sourcefile,$destfile,$filename,$new_w,$new_h)
{
			$system=explode('.',$filename);
			
			if (preg_match('/jpg|JPG|jpeg|JPEG/',$system[1])){
				$src_img=imagecreatefromjpeg($sourcefile);
			}
			if (preg_match('/gif|GIF/',$system[1])){
				$src_img=imagecreatefromgif($sourcefile);
			}
			if (preg_match('/png|PNG/',$system[1])){
				$src_img=imagecreatefrompng($sourcefile);
			}
			$old_x=imageSX($src_img);
			$old_y=imageSY($src_img);
			
			$thumb_w=$new_w;
			$thumb_h=$new_h;

			$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
			imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
			if (preg_match("/gif|GIF/",$system[1]))
			{
				imagegif($dst_img,$destfile); 
			}
			else if(preg_match("/png|PNG/",$system[1]))
			{
				imagepng($dst_img,$destfile); 
			} 
			else {
				imagejpeg($dst_img,$destfile); 
			}
			imagedestroy($dst_img); 
			imagedestroy($src_img); 
		}
/*// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}
	
	
	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'].time())){
		echo '{"status":"success"}';
		exit;
	}
}

echo '{"status":"error"}';
exit;*/

			   
				//$sqlFile = "select shot1 from tbl_gallery_images where id='".$_REQUEST['cid']."'";
				//$resFile = mysql_query($sqlFile) or die(mysql_error());
				//$rowFile = mysql_fetch_object($resFile);
				//@unlink("../uploadDirectory/".$rowFile->shot1);
				//@unlink("../uploadDirectory/thumbs/".$rowFile->shot1);
				$nnn=date('YmdHis');
			    $fileArray = explode('.',$_FILES["shot1"]['name']);
				$fileType = end($fileArray);
				$shot1 = "event_".$nnn. ".".$fileType; 
				$dest_path_thumb = "uploadDirectory/thumbs/".$shot1;
				$dest_path_thumb1 = "uploadDirectory/thumbs1/".$shot1;
				$dest_path = "uploadDirectory/".$shot1;
				createthumb($_FILES["shot1"]["tmp_name"],$dest_path_thumb,$shot1,70,61); // width, height
				createthumb($_FILES["shot1"]["tmp_name"],$dest_path_thumb1,$shot1,400,400); // width, height
				copy($_FILES["shot1"]["tmp_name"],$dest_path);
				$_REQUEST['shot1']=$shot1;
					if($_FILES['shot1']['name'] =="" )
					 {
						$shot1 = $_POST['shot1_old'];
					 }
					 else {
					 $shot1 = $shot1;   
					 }
	?>