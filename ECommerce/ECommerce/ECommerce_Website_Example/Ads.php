<?php
class Ads {
	private $adsPicture;
	private $adsUrl;
	private $adsStartDate;
	private $adsEndDate;
	private $adsApproveState;
	function __construct($adsPicture, $adsUrl, $adsStartDate, $adsEndDate, $adsApproveState) {
		$this->adsPicture = $adsPicture;
		$this->adsUrl = $adsUrl;
		$this->adsStartDate = $adsStartDate;
		$this->adsEndDate = $adsEndDate;
		$this->adsApproveState = $adsApproveStsate;
	}
	function getAdsPicture() {
		return $this->adsPicture;
	}
	function getAdsUrl() {
		return $this->adsUrl;
	}
	function getAdsEndDate() {
		return $this->adsEndDate;
	}
	function getAdsApproveState() {
		return $this->adsApproveState;
	}
	function getAdsStartDate() {
		return $this->adsStartDate;
	}
}