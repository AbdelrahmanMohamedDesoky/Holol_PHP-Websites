<?php
require_once('Admin.php');
if(!isset($_SESSION)){
	session_start();
} 
if(!isset($_SESSION['username'])){
	header( "Location: index.php");
	die();
}
$user = new User();
$userId = $_SESSION['userId'];
if(isset($_SESSION['username'])){
	if(!empty($_SESSION['userId'])){
		if($user->checkForBan($userId)){
		session_destroy();
		header( "Location: index.php");
	}
	else if ($_SESSION['userType'] == 0){
	echo "<center><b> Only Admin and Company Users can buy ads go back </b></center>";
	header("refresh:3; url= index.php");
	}
	}
}
?>