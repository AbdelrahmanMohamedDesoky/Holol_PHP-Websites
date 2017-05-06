<?php
require ("User.php");
class Admin extends User {
	protected $lastErrorMessage;
	function showUsers($type) {
		global $conn;
		$usersQuery;
		if($type == 1){
			$usersQuery = "SELECT * FROM user WHERE blockState IS NULL OR blockState = 0;";
		} else {
			$usersQuery = "SELECT * FROM user WHERE blockState = 1;";
		}
		$result = $conn->query ( $usersQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function showAds() {
		global $conn;
		$adsQuery = "SELECT * FROM ads;";
		$result = $conn->query ( $adsQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function showUnapprovedAds() {
		global $conn;
		$adsQuery = "SELECT * FROM ads WHERE adsApproveState = 0;";
		$result = $conn->query ( $adsQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function addCategory($categoryName) {
		global $conn;
		$categoryQuery = "INSERT INTO category (`categoryName`) VALUES('$categoryName');";
		$result = $conn->query ( $categoryQuery );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function addSubCategory($subName, $categoryId) {
		global $conn;
		$subCategoryQuery = "INSERT INTO subcategory (`subName`,`categoryId`) VALUES('$subName','$categoryId');";
		$result = $conn->query ( $subCategoryQuery );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function addSubSubCategory($subSubName, $subId) {
		global $conn;
		$subSubCategoryQuery = "INSERT INTO subsubcategory (`subSubName`,`subId`) VALUES('$subSubName','$subId');";
		$result = $conn->query ( $subSubCategoryQuery );
		if ($result !== false) { // query success
			return true;
		} else { // query fail
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function editCategory($categoryId, $categoryName) {
		global $conn;
		$editQuery = "UPDATE category SET `categoryName` = '$categoryName' WHERE categoryId=$categoryId;";
		$result = $conn->query ( $editQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function editSubCategory($subId, $subName) {
		global $conn;
		$editQuery = "UPDATE subcategory SET `subName` = '$subName' WHERE subId='$subId';";
		$result = $conn->query ( $editQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
  function editSubSubCategory($subSubId, $subSubName) {
        global $conn;
        $editQuery = "UPDATE subsubcategory SET `subSubName` = '$subSubName' WHERE subSubId=$subSubId;";
        $result = $conn->query($editQuery);
        if ($result !== false) {
            return true;
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
            return false;
        }
    }
	function deleteCategory($categoryId) {
		global $conn;
		$deleteQuery = "DELETE c, s ,ss FROM category c LEFT JOIN  subcategory s ON c.categoryId = s.categoryId LEFT JOIN subsubcategory ss ON s.subId = ss.subId WHERE  c.categoryId = '$categoryId'";
		$result = $conn->query ( $deleteQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
		}
	}
  function deleteSubCategory($subId) {
        global $conn;
        $deleteQuery = "DELETE s, ss FROM subcategory s LEFT JOIN subsubcategory ss  ON s.subId = ss.subId WHERE s.subId ='$subId';";
        $result = $conn->query($deleteQuery);
        if ($result !== false) {
            return true;
        } else {
            $this->lastErrorMessage = "Database Error : " . $conn->error;
        }
    }
	function deleteSubSubCategory($subSubId) {
		global $conn;
		$deleteQuery = "DELETE FROM `subsubcategory` WHERE `subSubId`='$subSubId'";

		$result = $conn->query ( $deleteQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
		}
	}
	function approveProduct($productId) {
		global $conn;
		$approveQuery = "UPDATE product SET approveState = 1 WHERE productId = '$productId';";
		$result = $conn->query ( $approveQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function approveAds($adsId) {
		global $conn;
		$approveQuery = "UPDATE ads SET adsApproveState = 1 WHERE adsId = '$adsId';";
		$result = $conn->query ( $approveQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function blockUser($userId) {
		global $conn;
		$blockQuery = "UPDATE user SET blockState = 1 WHERE userId = '$userId';";
		$result = $conn->query ( $blockQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function unBlockUser($userId) {
		global $conn;
		$blockQuery = "UPDATE user SET blockState = NULL WHERE userId = '$userId';";
		$result = $conn->query ( $blockQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function setOffer($productId, $discount) {
		global $conn;
		$offerQuery = "UPDATE product SET productDiscount='$discount' WHERE productId='$productId';";
		$result = $conn->query ( $offerQuery );
		if ($result !== false) { // sql query success
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function getProduct($productId) {
		global $conn;
		$selectQuery = "SELECT * FROM product p JOIN user u ON p.sellerId=u.userId JOIN subcategory s ON p.subId = s.subId LEFT JOIN subsubcategory ss ON p.subSubId = ss.subSubId WHERE productId='$productId';";
		$result = $conn->query ( $selectQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function showProduct($productName) {
		global $conn;
		if(!isset($_SESSION)){
			session_start();
		}
		$selectQuery = "SELECT * FROM product p JOIN user u ON p.sellerId=u.userId JOIN subcategory s ON p.subId = s.subId LEFT JOIN subsubcategory ss ON p.subSubId = ss.subSubId WHERE productName='$productName';";
		$result = $conn->query ( $selectQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function editProduct(Product $myProduct, $productId) {
		global $conn;
		$productName = $myProduct->getProductName ();
		$productCompany = $myProduct->getProductCompany ();
		$productPrice = $myProduct->getProductPrice ();
		$productDiscount = $myProduct->getProductDiscount ();
		$productDescription = $myProduct->getProductDescription ();
		$productRate = $myProduct->getProductRate ();
		$productQuantity = $myProduct->getProductQuantity ();
		$approveState = $myProduct->getApproveState ();
		$productPicture = $myProduct->getProductPicture ();
		$subId = $myProduct->getSubId ();
		$subSubId = $myProduct->getSubSubId ();
		$editProductQuery = "UPDATE product SET productName='$productName',
		productCompany='$productCompany',productPrice=$productPrice,productDiscount=$productDiscount,
		productDescription='$productDescription',productRate=$productRate,productQuantity=$productQuantity,
		approveState=$approveState,productPicture='$productPicture',subId=$subId,subSubId=$subSubId WHERE productId=$productId";
		$result = $conn->query ( $editProductQuery );
		if ($result !== false) { // sql query success
			return true;
		} else { // sql query fails no wonder.
			$this->lastErrorMessage = "Database Error : " . $conn->error;
		}
	}
	function deleteProduct($productId) {
		global $conn;
		$deleteQuery = "DELETE FROM product WHERE productId='$productId';";
		$result = $conn->query ( $deleteQuery );
		if ($result !== false) { // sql query success
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function setColor($color){
		global $conn;
		$colorQuery = "UPDATE color SET colorCode = '$color';";
		$result = $conn->query($colorQuery);
		if($result !== false){
			return true;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function categoriesNav() {
		global $conn;
		$selectQuery = "SELECT c.categoryId,c.categoryName,s.subId,s.subName,subSubId,subSubName FROM category c LEFT JOIN subcategory s ON c.categoryId = s.categoryId
                            LEFT JOIN subsubcategory ss ON s.subId = ss.subId;";
		$result = $conn->query($selectQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getSellerId($productId){
		global $conn;
		$selectQuery = "SELECT * FROM product WHERE productId='$productId';";
		$result = $conn->query($selectQuery);
		if ($result !== false) {
			$sellerRow = $result->fetch_assoc();
			return $sellerRow['sellerId'];
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getProductsBySubCategoryId($subId){
		global $conn;
		$subCategQuery = "SELECT * FROM product WHERE subId='$subId';";
		$result = $conn->query($subCategQuery);
		if($result !== false){
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return $false;
		}
	}
	function getProductsBySubSubCategoryId($subSubId){
		global $conn;
		$subSubCategQuery = "SELECT * FROM product WHERE subSubId='$subSubId';";
		$result = $conn->query($subSubCategQuery);
		if($result !== false){
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return $false;
		}
	}
	function getSubName($subId){
		global $conn;
		$subNameQuery = "SELECT * FROM subcategory WHERE subId = '$subId';";
		$result = $conn->query($subNameQuery);
		$subNameRow = $result->fetch_assoc();
		return $subNameRow['subName'];
	}
	function getSubSubName($subSubId){
		global $conn;
		$subSubNameQuery = "SELECT * FROM subsubcategory WHERE subSubId = '$subSubId';";
		$result = $conn->query($subSubNameQuery);
		$subSubNameRow = $result->fetch_assoc();
		return $subSubNameRow['subSubName'];
	}
	function getAllProductsWithoutDiscount(){
		global $conn;
		$allQuery = "SELECT * FROM product WHERE productDiscount = 0 AND productQuantity > 0 AND approveState = 1";
		$result = $conn->query($allQuery);
		if($result !== false){
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getOfferedProducts(){
		global $conn;
		$allQuery = "SELECT * FROM product WHERE productDiscount > 0 AND productQuantity > 0 AND approveState = 1";
		$result = $conn->query($allQuery);
		if($result !== false){
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getAds($adsType){
		global $conn;
		$getQuery = "SELECT * FROM ads WHERE typeId='$adsType' AND adsApproveState = 1;";
		$result = $conn->query($getQuery);
		if($result !== false){
			if($result->num_rows > 0){
				return $result;
			} else {
				return false;
			}
		}
		return false;
	}
}

?>
