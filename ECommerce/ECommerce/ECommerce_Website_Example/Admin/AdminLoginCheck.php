<?php
require_once('../Admin.php');
if(!isset($_SESSION)){
	session_start();
} 
if(!isset($_SESSION['username'])){
	header( "Location: ../index.php");
	die();
}
$user = new User();
$userId = $_SESSION['userId'];
if(isset($_SESSION['username'])){
	if(!empty($_SESSION['userId'])){
		if($user->checkForBan($userId)){
		session_destroy();
		header("Location: ../index.php");
		}
		else if($_SESSION['userType'] != 2){
		session_destroy();
		header( "Location: ../index.php" );
		}
	}
} else {
	header("Locatin: ../index.php");
}
?>