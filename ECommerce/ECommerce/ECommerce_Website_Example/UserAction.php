<?php
require_once("loginCheck.php");
require_once("Validation.php");
$validator = new Validation();
if (isset($_POST ['addProduct'])) {
    $productName = cleanSQL($_POST ['productName']);
    $productCompany = cleanSQL($_POST ['productCompany']);
    $productPrice = cleanSQL($_POST ['productPrice']);
    $productDiscount = cleanSQL($_POST ['productDiscount']);
    $productDescription = cleanSQL($_POST ['productDescription']);
    $productQuantity = cleanSQL($_POST ['productQuantity']);
    $file = $_FILES ['img']['tmp_name']; // img
    $productPicture = uniqid(); // img name
    move_uploaded_file($file, "./images/$productPicture.jpg");
    $categoryId = cleanSQL($_POST['categoryId']);
    $subId = cleanSQL($_POST['subId']);
    $subSubId = cleanSQL($_POST['subSubId']);
    $product = new Product($productName, $productCompany, $productPrice, $productDiscount, $productDescription, 0, $productQuantity, 1, $productPicture, $subId, $subSubId);
    if($validator->validateLength($productName, 6) &&
       	$validator->validateLength($productCompany, 6) &&
    	$validator->validateLength($productDescription, 6) &&
       	$validator->validatePrice($productPrice) &&
      	$validator->validateOffer($productDiscount) &&
   		$validator->validateQuantity($productQuantity) &&
    	$validator->validateImage($_FILES) &&
    	$validator->validateSubCategory($categoryId, $subId) &&
    	$validator->validateSubSubCategory($subId, $subSubId)){
    	$user->addProduct($product);
    	$userMessage = "Product Has Been Added Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if (isset($_POST ['editProduct'])) {
	  $productId = cleanSQL($_POST['productId']);
	  $productName = cleanSQL($_POST ['productName']);
    $productCompany = cleanSQL($_POST ['productCompany']);
    $productPrice = cleanSQL($_POST ['productPrice']);
    $productDiscount = cleanSQL($_POST ['productDiscount']);
    $productDescription = cleanSQL($_POST ['productDescription']);
    $productQuantity = cleanSQL($_POST ['productQuantity']);
    $newImage = false;
    if(!empty($_FILES ['img']['tmp_name'])){
      $file = $_FILES['img']['tmp_name'];
      if($validator->validateImage($_FILES)){
        $productPicture = uniqid();
        move_uploaded_file($file, "./images/$productPicture.jpg");
      } else {
        $userMessage = $validator->getLastError() . " So it wasn't updated";
        $productPicture = $user->getProductPicture($productId);
      }
    } else {
      $productPicture = $user->getProductPicture($productId);
    }
    $product = new Product($productName, $productCompany, $productPrice, $productDiscount, $productDescription, NULL, $productQuantity, 0, $productPicture, NULL, NULL);
    if($validator->validateLength($productName, 6) &&
       	$validator->validateLength($productCompany, 6) &&
        $validator->validateLength($productDescription, 6) &&
       	$validator->validatePrice($productPrice) &&
      	$validator->validateOffer($productDiscount) &&
        $validator->validateQuantity($productQuantity)){
    	if($user->editProduct($product,$productId)){
          $userMessage = "Product Has Been Edit Successfully";
      } else {
          $userMessage = $user->getLastErrorMessage();
      }
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if (isset($_POST ['deleteProduct'])){
    $productId = cleanSQLNationalId($_POST['productId']);
    if($validator->validateLength($productId,1)){
    	if($user->deleteProduct($productId)){
          $userMessage = "Product has been succesfully deleted";
      } else {
          $userMessage = $user->getLastErrorMessage();
        }
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if (isset($_POST ["addEditOffer"])) {
    $productId = cleanSQLNationalId($_POST ["productId"]);
    $productDiscount = cleanSQLNationalId($_POST ["productDiscount"]);
    if($validator->validateLength($productId,1) &&
    	$validator->validateOffer($productDiscount)){
    	$user->setOffer($productId,$productDiscount);
    	$userMessage = "Successfully Added/Edited Offer";
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if (isset($_POST ["deleteOffer"])) {
    $productId = cleanSQLNationalId($_POST ["productId"]);
    $productDiscount = 0;
    if($validator->validateLength($productId, 1)){
    	$user->setOffer($productId,$productDiscount);
    	$userMessage = "Successfully Deleted Offer";
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if (isset($_GET['addWishList'])){
	$productId = cleanSQLNationalId($_GET['addWishList']);
	if($validator->validateLength($productId, 1)){
		$user->addWishlist($productId);
		$userMessage = "Successfully Added to WishList";
	} else {
		$userMessage = $validator->getLastError();
	}
}
else if (isset($_GET['addToCart'])){
  if(isset($_GET['productId'])){
    if(!empty(cleanSQLNationalId($_GET['productId']))){
      $productId = cleanSQLNationalId($_GET['productId']);
      if($validator->validateItemBeforeCart($productId)){
        if($user->addCart($productId)){
          $userMessage = "Product Has been added to cart successfully";
        } else {
		  $userMessage = $user->getLastErrorMessage();
		}
      } else {
        $userMessage = "You can't add the same product again, edit it's quantity inside cart if you want more";
      }
    } else {
      $userMessage = "Error : No Item Found";
    }
  }
}
else if(isset($_GET['updateQuantity'])){
  if(isset($_GET['productId']) && isset($_GET['quantity'])){
    if(!empty($_GET['productId']) && !empty($_GET['quantity'])){
      $productId = cleanSQLNationalId($_GET['productId']);
      $productQuantity = cleanSQLNationalId($_GET['quantity']);
      if($validator->validateCartQuantity($productId,$productQuantity)){
        if($user->updateQuantity($productId,$productQuantity)){
          $userMessage = "Updated Quantity successfully";
        } else {
          $userMessage = $user->getLastErrorMessage();
        }
      } else {
        $userMessage = $validator->getLastError();
      }
    } else {
      $userMessage = "Quantity Or Product Id Can't be Empty/0";
    }
  } else {
    $userMessage = "Error : Item not Found ";
  }
}
else if (isset($_GET['deleteFromCart'])){
	$productId = cleanSQLNationalId($_GET['deleteFromCart']);
	if($validator->validateLength($productId, 1)){
		$user->deleteCart($productId);
		$userMessage = "Successfully deleted from Cart";
	} else {
		$userMessage = $validator->getLastError();
	}
}
else if (isset($_GET['deleteFromWishList'])){
	$productId = cleanSQLNationalId($_GET['deleteFromWishList']);
	if($validator->validateLength($productId, 1)){
		$user->deleteWishList($productId);
		$userMessage = "Successfully deleted from WishList";
	} else {
		$userMessage = $validator->getLastError();
	}
}
else if (isset($_GET['rateProduct'])){
	$productId = cleanSQLNationalId($_GET['productId']);
	$userRate = cleanSQLNationalId($_GET['userRate']);
	if($validator->validateLength($productId, 1) &&
		$validator->validateRate($userRate) &&
		$validator->validateRateBefore($productId)){
		$user->rateProduct($productId, $userRate);
		$userMessage = "Product Has been Rated Successfully";
	} else {
		$userMessage = $validator->getLastError();
	}
}
?>

<html>
    <script>
<?php
if(!isset($userMessage)){
  $userMessage = "";
}
echo "var userMessage = \"$userMessage\";";
$userMessage = NULL;
?>
        if (userMessage != 'undefined' && userMessage != "") {
            alert(userMessage);
        }
        window.setTimeout(function () {
            window.location.href = 'user-profile.php';
        }, 500);
    </script>
</html>
