<?php 
session_start();
require('companyLoginCheck.php');
require('db_connect.php');
require('Validation.php');
$userId = $_SESSION['userId'];
$validator = new Validation();
$adsId = cleanSQLNationalId($_POST['adsId']);
$adsUrl = $_POST['adsUrl'];
date_default_timezone_set("Egypt");
$adsEndDate = date("Y-m-d", strtotime(" +1 months"));
if($validator->validateAdsId($adsId) && $validator->validateAdsUrl($adsUrl) && $validator->validateImage($_FILES)){
	$adsPicture = uniqid();
	move_uploaded_file($_FILES['img']['tmp_name'], "images/$adsPicture.jpg");
	$insertQuery = "INSERT INTO ads VALUES(NULL,'$adsId','$adsPicture','$adsUrl',NOW(),'$adsEndDate',0,'$userId');";
	$result = $conn->query($insertQuery);
	if($result !== false){
		echo "<center><b> Ads Has been successfully added </b> </center>";
		header( "refresh:3; url=index.php" );
	}
} else {
	echo $validator->getLastError().  " : You will be redirected back again to fix that input error" ;
	header( "refresh:3; url=buyAds.php?id=$adsId" );
}
?>
