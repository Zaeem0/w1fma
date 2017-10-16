<?php
function resizeIMG($newname,$out,$newwidth,$newheight){
	//img resizing
	$src = imagecreatefromjpeg($newname);
	list($width,$height) = getimagesize($newname);
	if($width<$newwidth && $height<$newheight){	
		return FALSE;
	}else{	
			 //landscape
			 if($width>$height){
			 $newheight=($height/$width) * $newwidth;
			 
			 //portrait and square
			 }else{
				 
			 $newwidth=($width/$height) * $newheight;
			 }

			 $tmp = imagecreatetruecolor($newwidth,$newheight);
			 imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			 imagejpeg($tmp,"$out",100);
			 imagedestroy($tmp);
			 imagedestroy($src);
	}
}

function sanitize($var) {
$var=stripslashes($var);
$var=htmlentities($var);
$var=strip_tags($var);
return $var;
}
?>