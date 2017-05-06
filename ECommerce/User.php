<?php
require ("db_connect.php");
require ("Product.php");
class User {
	protected $lastErrorMessage;
	function getLastErrorMessage() {
		return $this->lastErrorMessage;
	}
	function signin($username, $password) {
		global $conn;
		$password = md5 ( $password );
		$signinQuery = "SELECT * FROM user WHERE username='$username' AND password='$password';";
		$result = $conn->query ( $signinQuery );
		if ($result !== false) { // sql query success
			if ($result->num_rows == 1) { // successfull login
				$row = $result->fetch_assoc ();
				if (! isset ( $_SESSION )) {
					session_start (); // start session
					if ($row ['blockState'] != 1) {
						$_SESSION ['username'] = $username;
						$_SESSION ['userId'] = $row ['userId'];
						$_SESSION ['userType'] = $row ['userType'];
					} else {
						$this->lastErrorMessage = "You are blocked get out of here";
						return false;
					}
				}
				return true;
			} else { // wrong username/password
				$this->lastErrorMessage = "Wrong Username/Password Please Check";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function signup($username, $password, $email, $nationalId, $userType) {
		global $conn;
		$password = md5 ( $password );
		$registerQuery = "INSERT INTO user(`userId`,`username`,`email`,`password`,`nationalId`,`userType`) VALUES('NULL','$username','$email','$password','$nationalId','$userType');";
		$result = $conn->query ( $registerQuery );
		if ($result !== false) { // sql query success
			return true;
		} else { // sql query fails no wonder.
			die ( "Database Error : " . $conn->error );
		}
	}
	function setOffer($productId, $discount) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$offerQuery = "UPDATE product SET productDiscount='$discount' WHERE productId='$productId' AND sellerId='$userId'";
		$result = $conn->query ( $offerQuery );
		if ($result !== false) { // sql query success
			if($conn->affected_rows > 0){
				return true;
			} else {
				$this->lastErrorMessage = "This Product isn't yours, you can't edit it's offer";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function addProduct(Product $myProduct) {
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
		$subSubId;
		if ($myProduct->getSubSubId() == -1) {
			$subSubId = 'NULL';
		} else {
			$subSubId = $myProduct->getSubSubId ();
		}
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		if ($_SESSION ['userType'] == 2) { // admin are automaticlly approved
			$approveState = 1;
		} else {
			$approveState = 0;
		}
		$sellerId = $_SESSION ['userId'];
		$addProductQuery = "INSERT INTO `product` (`productName`, `productCompany`, `productPrice`, `productDiscount`, `productDescription`, `productRate`, `productQuantity`, `approveState`, `productPicture`, `subId`, `subSubId`, `sellerId`) VALUES ('$productName','$productCompany','$productPrice','$productDiscount','$productDescription','$productRate','$productQuantity','$approveState','$productPicture',$subId,$subSubId,$sellerId);";
		$result = $conn->query ( $addProductQuery );
		if ($result !== false) { // sql query success
			return true;
		} else { // sql query fails no wonder.
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function editProduct(Product $myProduct, $productId) {
		global $conn;
		if(!isset($_SESSION)){
			session_start();
		}
		$sellerId = $_SESSION ['userId'];
		$productName = $myProduct->getProductName ();
		$productCompany = $myProduct->getProductCompany ();
		$productPrice = $myProduct->getProductPrice ();
		$productDiscount = $myProduct->getProductDiscount ();
		$productDescription = $myProduct->getProductDescription ();
		$productQuantity = $myProduct->getProductQuantity ();
		if ($_SESSION ['userType'] == 2) {
			$approveState = 1;
		} else {
			$approveState = 0;
		}
		$productPicture = $myProduct->getProductPicture ();
		$editProductQuery = "UPDATE product SET productName='$productName',
		productCompany='$productCompany',productPrice=$productPrice,productDiscount=$productDiscount,
		productDescription='$productDescription',productQuantity=$productQuantity,
		approveState=$approveState,productPicture='$productPicture' WHERE productId=$productId AND sellerId = '$sellerId';";
		$result = $conn->query ( $editProductQuery );
		if ($result !== false) { // sql query success
			if($conn -> affected_rows > 0){
				return true;
			} else {
				$this->lastErrorMessage = "Nothing was updated !";
				return false;
			}
		} else { // sql query fails no wonder.
			$this->lastErrorMessage = "Database Error : " . $conn->error;
		}
	}
	function deleteProduct($productId) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$sellerId = $_SESSION ['userId'];
		$deleteQuery = "DELETE FROM product WHERE productId='$productId' AND sellerId = '$sellerId';";
		$result = $conn->query ( $deleteQuery );
		if ($result !== false) { // sql query success
			if($conn->affected_rows > 0){
				return true;
			} else {
				$this->lastErrorMessage = "You can't delete another person product";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function getProduct($productId) {
		global $conn;
		if(!isset($_SESSION)){
			session_start();
			$userId = $_SESSION['userId'];
		}
		$selectQuery = "SELECT * FROM product p JOIN user u ON p.sellerId=u.userId JOIN subcategory s ON p.subId = s.subId LEFT JOIN subsubcategory ss ON p.subSubId = ss.subSubId WHERE productId='$productId' AND sellerId ='$userId';";
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
		$userId = $_SESSION['userId'];
		$selectQuery = "SELECT * FROM product p JOIN user u ON p.sellerId=u.userId JOIN subcategory s ON p.subId = s.subId LEFT JOIN subsubcategory ss ON p.subSubId = ss.subSubId WHERE productName='$productName' AND sellerId = '$userId';";
		$result = $conn->query ( $selectQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function showSoldProducts() {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$sellerId = $_SESSION ['userId'];
		$soldQuery = "SELECT * FROM soldproduct WHERE sellerId = '$sellerId';";
		$result = $conn->query ( $soldQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
		}
	}
	function showBoughtProducts() {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$buyerId = $_SESSION ['userId'];
		$soldQuery = "SELECT * FROM soldproduct WHERE buyerId = '$buyerId';";
		$result = $conn->query ( $soldQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
		}
	}
	function updateAverageRate($productId) {
		global $conn;
		$allRateQuery = "SELECT * FROM rate WHERE productId='$productId' ";
		$result = $conn->query ( $allRateQuery );
		if ($result !== false) { // sql query success
		                         // output data of each row
			$allRate = 0;
			if ($result->num_rows > 0) {
				$allNo = $result->num_rows;
				while ( $row = $result->fetch_assoc () ) {
					$allRate += $row ['rateValue'];
				}
				$avgRate = $allRate / $allNo;
			}
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
		$editProductQuery = "UPDATE `product` SET `productRate`=$avgRate WHERE productId='$productId';";
		$result = $conn->query ( $editProductQuery );
		if ($result !== false) { // sql query success
			return true;
		} else { // sql query fails no wonder.
			$this->lastErrorMessage = "Database Error : " . $conn->error;
		}
	}
	function rateProduct($productId, $rateValue) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$productRateQuery = " INSERT INTO `rate`( `userId`, `productId`, `rateValue`, `rateDate`) " . "VALUES ( $userId,$productId ,$rateValue,NOW())";
		$result = $conn->query ( $productRateQuery );
		if ($result !== false) { // sql query success
			$this->updateAverageRate($productId);
			return true;
		} else { // sql query fails no wonder.
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function deleteWishList($productId) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$deleteWishListQuery = "DELETE FROM `wishlist` WHERE `userId`='$userId' AND `productId`='$productId'";
		$result = $conn->query ( $deleteWishListQuery );
		if ($result !== FALSE) {
			return TRUE;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return FALSE;
		}
	}
	function deleteCart($productId) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$deleteCartQuery = "DELETE FROM `cart` WHERE `userId`='$userId' AND `productId`='$productId'";
		$result = $conn->query ( $deleteCartQuery );
		if ($result !== FALSE) {
			return TRUE;
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return FALSE;
		}
	}
	function addCart($productId) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$addQuery = "insert into cart value('$userId','$productId',1)";
		$result = $conn->query ( $addQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function updateQuantity($productId,$prodcutQuantity){
		global $conn;
		if(!isset($_SESSION)){
			session_start();
		}
		$userId = $_SESSION['userId'];
		$updateQuery = "UPDATE `cart` SET `productQuantity` = '$prodcutQuantity' WHERE productId = '$productId' AND userId='$userId';";
		$result = $conn->query($updateQuery);
		if($result !== false){
			if($conn->affected_rows > 0){
				return true;
			} else {
				$this->lastErrorMessage = "Error : Nothing was Updated !";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
		}
	}
	function getCart() {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$cartQuery = "SELECT * FROM product p JOIN Cart c ON p.productId=c.productId Where userId='$userId'";
		$result = $conn->query ( $cartQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
		}
	}
	function getWishList() {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$wishListQuery = "SELECT * FROM wishlist Where userId='$userId';";
		$result = $conn->query ( $wishListQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
		}
	}
	function addWishlist($productId) {
		global $conn;
		if (! isset ( $_SESSION )) {
			session_start ();
		}
		$userId = $_SESSION ['userId'];
		$addQuery = "insert into wishlist value('$userId','$productId')";
		$result = $conn->query ( $addQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getUsernameInfo($username) {
		global $conn;
		$infoQuery = "SELECT * FROM user WHERE username='$username';";
		$result = $conn->query ( $infoQuery );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function editPassword($username, $password) {
		global $conn;
		$updatePasswordQuery = "UPDATE user SET password='$password' WHERE username='$username';";
		$result = $conn->query ( $updatePasswordQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function editEmail($username, $email) {
		global $conn;
		$updateEmailQuery = "UPDATE user SET email='$email' WHERE username='$username';";
		$result = $conn->query ( $updateEmailQuery );
		if ($result !== false) {
			return true;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function updateUserImage($username, $imgTemp) {
		if (move_uploaded_file ( $imgTemp, "images/$username.jpg" )) {
			return true;
		} else {
			return false;
		}
	}
	function getCategories() {
		global $conn;
		$showCategory = "SELECT * FROM category;";
		$result = $conn->query ( $showCategory );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getSubCategories() {
		global $conn;
		$showSubCategory = "SELECT * FROM subcategory;";
		$result = $conn->query ( $showSubCategory );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getSubSubCateogories() {
		global $conn;
		$showSubSubCategory = "SELECT * FROM subsubcategory;";
		$result = $conn->query ( $showSubSubCategory );
		if ($result !== false) {
			return $result;
		} else {
			$this->lastErrorMessage = "Error : " . $conn->error;
			return false;
		}
	}
	function getColor() {
		global $conn;
		$colorQuery = "SELECT * FROM color;";
		$result = $conn->query ( $colorQuery );
		if ($result !== false) {
			$colorRow = $result->fetch_assoc ();
			return $colorRow ['colorCode'];
		} else {
			$this->lastErrorMessage = "Database Error : " . $conn->error;
			return false;
		}
	}
	function checkForBan($userId) {
		global $conn;
		$banQueryCheck = "SELECT * FROM user WHERE userId='$userId';";
		$result = $conn->query ( $banQueryCheck );
		if ($result !== false) {
			if ($result->num_rows == 1) {
				$row = $result->fetch_assoc ();
				if ($row['blockState'] == 1)
					return true;
				else
					return false;
			}
		}
	}
	function getProductPicture($productId){
		global $conn;
		$sql = "SELECT * FROM Product WHERE productId = '$productId';";
		$result = $conn->query($sql);
		if($result !== false){
		$productRow = $result->fetch_assoc();
		return $productRow['productPicture'];
		}
	}
}
?>
