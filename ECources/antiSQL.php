<?php
function cleanSQL($text){
	$cleanText = str_replace("/","",$text);
	$cleanText = str_replace("\\","",$cleanText);
	$cleanText = str_replace("'","",$cleanText);
	$cleanText = str_replace("\"","",$cleanText);
	$cleanText = str_replace("`","",$cleanText);
	$cleanText = str_replace("=","",$cleanText);
	$cleanText = str_replace("!","",$cleanText);
	$cleanText = str_replace("|","",$cleanText);
	$cleanText = str_replace("*","",$cleanText);
	$cleanText = str_replace(";","",$cleanText);
	$cleanText = str_replace("-","",$cleanText);
    $cleanText = str_replace("%","",$cleanText);
    $cleanText = str_replace("$","",$cleanText);
    $cleanText = str_replace("&","",$cleanText);
	$cleanText = stripslashes($cleanText);
	return $cleanText;
}
?>