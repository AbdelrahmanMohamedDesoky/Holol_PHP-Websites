<?php
function cleanSQL($text){
	$cleanText = preg_replace("/[^a-zA-Z0-9 @#.-_]+/","",$text);
	$cleanText = trim($cleanText);
	$cleanText = strip_tags($cleanText);
	return $cleanText;
}
function cleanSQLNumbers($text){
	$cleanText = preg_replace("/[^0-9]+/","",$text);
	return $cleanText;
}
?>