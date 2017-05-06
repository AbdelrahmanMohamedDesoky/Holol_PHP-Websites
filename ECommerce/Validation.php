<?php
require_once ('db_connect.php');
require_once ('Admin.php');
class Validation {
	protected $lastErrorMessage;
	public function getLastError() {
		return $this->lastErrorMessage;
	}
	public function validateEmail($text) {
		if (strlen($text) < 4){
			$this->lastErrorMessage = "There is no way you can have an Email Address less than 5 chars";
			return false;
		}
		else if (filter_var ( $text, FILTER_VALIDATE_EMAIL ) === false) {
			$this->lastErrorMessage = "Email Address not valid";
			return false;
		} else {
			global $conn;
			$emailQuery = "SELECT * FROM user WHERE email ='$text';";
			$result = $conn->query ( $emailQuery );
			if ($result->num_rows > 0) {
				$this->lastErrorMessage = "Email Address already exists !";
				return false;
			} else {
				return true;
			}
		}
	}
	public function validateUsername($text) {
		if(strlen($text) < 6){
			$this->lastErrorMessage = "Sorry Username Can't be less than 6 Characters";
		} else {
			global $conn;
			$usernameQuery = "SELECT * FROM user where username = '$text';";
			$result = $conn->query ( $usernameQuery );
			if ($result->num_rows > 0) {
				$this->lastErrorMessage = "Username Already Exists";
				return false;
			} else {
				return true;
			}
		}
	}
	public function validateNationalId($text) {
		if(strlen($text) != 14){
			$this->lastErrorMessage = "National Id is a 14 digit number";
			return false;
		} else {
			global $conn;
			$usernameQuery = "SELECT * FROM user where nationalId = '$text';";
			$result = $conn->query ( $usernameQuery );
			if ($result->num_rows > 0) {
				$this->lastErrorMessage = "National ID Already Exists";
				return false;
			} else {
				return true;
			}
		}
	}
	public function validateUserType($text) {
		$text = (int)$text;
		if ($text != '0' && $text != '1') {
			$this->lastErrorMessage = "UserType can't be anything except User Or Company ( 0 Or 1 )";
			return false;
		} else {
			return true;
		}
	}
	public function validateImage($img) {
		if (strlen ( $img ['img'] ['tmp_name'] ) < 1) {
			$this->lastErrorMessage = "Error Image wasn't Uploaded";
			return false;
		} else if (! (strpos ( $img ['img'] ['type'], 'image' ) !== false)) {
			$this->lastErrorMessage = "The uploaded Image wasn't an Image (Allowed Extensions jpg,png,jpeg,gif)";
			return false;
		} else {
			return true;
		}
	}
	public function validateSubCategory($categoryId, $subId) {
		if (strlen ( $categoryId ) < 1 || strlen ( $subId ) < 1) {
			$this->lastErrorMessage = "CategoryId || SubId can't be empty";
			return false;
		} else  {
			global $conn;
			$subQuery = "SELECT * FROM subcategory WHERE subId='$subId' AND categoryId='$categoryId';";
			$result = $conn->query($subQuery);
			if($result !== false){
				if($result->num_rows < 1){
					$this->lastErrorMessage = "LOL/SubCategory Error Please don't manually edit values";
					return false;
				} else {
					return true;
				}
			}
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	public function validateSubSubCategory($subId, $subSubId) {
		if(strlen($subId) > 0 && strlen($subSubId) > 0){
					global $conn;
		if($subSubId == -1){
			$subSubQuery = "SELECT * FROM subcategory WHERE subId='$subId';";
		} else {
			$subSubQuery = "SELECT * FROM subsubcategory WHERE subId='$subId' AND subsubId='$subSubId';";
		}
		$result = $conn->query ( $subSubQuery );
		if ($result !== false) {
			if ($result->num_rows < 1) {
				var_dump($subSubQuery);
				die();
				$this->lastErrorMessage = "Category/SubCategory Error Please don't manually edit values";
				return false;
			} else {
				return true;
			}
		}
		$this->lastErrorMessage = "Error : " . $conn->error;
		return false;
		}
	}
	public function validateOffer($discount){
		if (filter_var($discount, FILTER_VALIDATE_INT) === false) {
			$this->lastErrorMessage = "Error Amount Must be an Integer";
			return false;
			} else {
				if($discount <= 99 && $discount >= 0)
					return true;
				else
				$this->lastErrorMessage = "Product Offer can't be less than 0% or greater than 99%";
				return false;
			}
	}
	public function validatePrice($price){
		if (filter_var($price, FILTER_VALIDATE_FLOAT) === false) {
			$this->lastErrorMessage = "Error Price Must be an Integer";
			return false;
		} else {
			if($price < 1){
				$this->lastErrorMessage = "Error Price Can't be less than 1";
				return false;
			} else {
				return true;
			}
		}
	}
	public function validateQuantity($quantity){
		if (filter_var($quantity, FILTER_VALIDATE_INT) === false) {
			$this->lastErrorMessage = "Error Quantity Must be an Integer";
			return false;
		} else {
			if($quantity < 0){
				$this->lastErrorMessage = "Error Quantity Can't be less than 0";
				return false;
			} else {
				return true;
			}
		}
	}
	public function validateLength($text,$length,$errorWord = "Error"){
		if(strlen($text) < $length){
			$this->lastErrorMessage = "$errorWord can't be less than $length";
			return false;
		} else {
			return true;
		}
	}
	public function validateAdsId($adsId){
		if(strlen($adsId) <  1){
			$this->lastErrorMessage = "AdsId Error";
			return false;
		}
		else if ($adsId < 1 || $adsId > 4){
			$this->lastErrorMessage = "AdsId Error";
			return false;
		} else {
			global $conn;
			$selectQuery = "SELECT * FROM ads WHERE typeId = '$adsId';";
			$result = $conn->query($selectQuery);
			if($result !== false){
				if ($result->num_rows > 0){
					$this->lastErrorMessage = "AdsId Taken Please choose another Ad";
					return false;
				} else {
					return true;
				}
			}
		}
	}
	public function validateAdsUrl($url){
		if(filter_var($url, FILTER_VALIDATE_URL) === false){
			$this->lastErrorMessage = "Invalid Ads Url";
			return false;
		} else {
			return true;
		}
	}
	public function validateRate($rate){
		if(strlen($rate) < 0){
			$this->lastErrorMessage = "Rate can't be empty";
			return false;
		}
		else if (filter_var($rate, FILTER_VALIDATE_INT) === false){
			$this->lastErrorMessage = "Rate can't be anything except Integer";
			return false;
		}
		else if ($rate <  0 || $rate > 5){
			$this->lastErrorMessage = "Rate can't be less than 0 or greater than 5";
			return false;
		} else {
			return true;
		}
	}
	public function validateRateBefore($productId){
		if(!isset($_SESSION)){
			session_start();
		}
		$userId = $_SESSION['userId'];
		global $conn;
		$query= "SELECT * FROM rate WHERE userId='$userId' AND productId='$productId';";
		$result = $conn->query($query);
		if($result !== false){
			if($result->num_rows > 0){
				$this->lastErrorMessage = "You have already rated this product";
				return false;
			} else {
				return true;
			}
		}
		return false;
	}
	public function validateItemBeforeCart($productId){
		global $conn;
		if(!isset($_SESSION)){
			session_start();
		}
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM Cart WHERE userId='$userId';";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$productArray = array();
			while($cartRow = $result->fetch_assoc()){
				array_push($productArray,$cartRow['productId']);
			}
			if(in_array($productId,$productArray)){
				$this->lastErrorMessage = "Product already in cart , you can change it's quantity from cart";
				return false;
			} else {
				return true;
			}
		} else {
			return true;
		}
	}
	public function validateCartQuantity($productId,$productQuantity){
		if($productQuantity < 1){
			$this->lastErrorMessage = "Invalid Quantity";
			return false;
		}
		global $conn;
		$admin = new Admin();
		if(isset($productId)){
			$result = $admin->getProduct($productId);
			$productRow = $result->fetch_assoc();
			$realQuantity = $productRow['productQuantity'];
			if($realQuantity < $productQuantity){
				$this->lastErrorMessage = "Sorry , The maximum quantity for this product is $realQuantity";
				return false;
			} else {
				return true;
			}
		} else {
			$this->lastErrorMessage = "Product Not Found";
		}
	}
}
?>
