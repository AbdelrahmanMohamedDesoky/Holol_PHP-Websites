<?php
require 'Ads.php';
class Company extends User {
	function addAds(Ads $myAds) {
		global $conn;
		$adsPicture = $myAds->getAdsPicture ();
		$adsUrl = $myAds->getAdsUrl ();
		$adsStartDate = $myAds->getAdsStartDate ();
		$adsEndDate = $myAds->getAdsEndDate ();
		$dsApproveState = $myAds->getAdsApproveState ();
		$AdsQuery = "INSERT INTO ads (`adsPicture`,adsUrl`,`adsStartDate`,`adsEndDate`,`adsApproveState`) VALUES('$adsPicture','$adsUrl','$adsStartDate','$adsEndDate','$dsApproveState');";
		$result = $conn->query ( $AdsQuery );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function deleteAds($adsId) {
		global $conn;
		$deleteAds = "DELETE FROM `ads` WHERE 'adsid'='$adsId'";
		$result = $conn->query ( $deleteAds );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function editAds($adsId) {
		global $conn;
		$adsPicture = $myAds->getAdsPicture ();
		$adsUrl = $myAds->getAdsUrl ();
		$adsStartDate = $myAds->getAdsStartDate ();
		$adsEndDate = $myAds->getAdsEndDate ();
		$adsApproveState = $myAds->getAdsApproveState ();
		$editAds = "UPDATE `ads` SET `adsPicture`='$adsPicture', `adsUrl`='$adsUrl' , `adsStartDate`='$adsStartDate' , `adsEndDate`='$adsEndDate' , `adsApproveState`='$adsApproveState' WHERE adsId = '$adsId';";
		$result = $conn->query ( $editAds );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
}