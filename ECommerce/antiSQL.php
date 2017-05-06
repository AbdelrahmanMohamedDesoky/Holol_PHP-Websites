<?php
function cleanSQL($text){
	if(strlen($text) == 0){
		return "";
	}
	$cleanText = preg_replace("/[^a-zA-Z0-9 @#.\-_]+/","",$text);
	$cleanText = trim($cleanText);
	$cleanText = strip_tags($cleanText);
	return $cleanText;
}
function cleanSQLNationalId($text){
	if(strlen($text) == 0){
		return "";
	}
	$cleanText = preg_replace("/[^0-9 -.]+/","",$text);
	return $cleanText;
}
?>
