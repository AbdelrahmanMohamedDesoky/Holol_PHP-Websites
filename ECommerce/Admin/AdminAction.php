<?php
require("./AdminLoginCheck.php");
require("../Validation.php");
$validator = new Validation();
$admin = new Admin ();
if (isset($_POST ['addProduct'])) {
	if(isset($_POST['productName']) &&
		isset($_POST['productCompany']) &&
		isset($_POST['productPrice']) &&
		isset($_POST['productDiscount']) &&
		isset($_POST['productDescription']) &&
		isset($_POST['productQuantity']) &&
		!empty($_FILES['img']['tmp_name']) &&
		isset($_POST['categoryId']) &&
		isset($_POST['subId'])){
    $productName = cleanSQL($_POST ['productName']);
    $productCompany = cleanSQL($_POST ['productCompany']);
    $productPrice = cleanSQL($_POST ['productPrice']);
    $productDiscount = cleanSQL($_POST ['productDiscount']);
    $productDescription = cleanSQL($_POST ['productDescription']);
    $productQuantity = cleanSQL($_POST ['productQuantity']);
    $file = $_FILES ['img']['tmp_name']; // img
    $productPicture = uniqid(); // img name
    move_uploaded_file($file, "../images/$productPicture.jpg");
    $categoryId = cleanSQL($_POST['categoryId']);
    if(isset($_POST['subId'])){
		$subId = $_POST['subId'];	
	}
	if(isset($_POST['subSubId'])){
		$subSubId = $_POST['subSubId'];
	}
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
    	$admin->addProduct($product);
    	$userMessage = "Product Has Been Added Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
	} else {
		$userMessage = "Data Missing";
	}
}
else if (isset($_POST ['editProduct'])) {
    $productName = cleanSQL($_POST ['productName']);
    $productCompany = cleanSQL($_POST ['productCompany']);
    $productPrice = cleanSQL($_POST ['productPrice']);
    $productDiscount = cleanSQL($_POST ['productDiscount']);
    $productDescription = cleanSQL($_POST ['productDescription']);
    $productQuantity = cleanSQL($_POST ['productQuantity']);
    $file = $_FILES ['img']['tmp_name']; // img
    $productPicture = uniqid(); // img name
    move_uploaded_file($file, "../images/$productPicture.jpg");
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
    	$admin->addProduct($product);
    	$userMessage = "Product Has Been Added Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ['deleteProduct'])){
    $productId = cleanSQLNationalId($_POST['productId']);
    if($validator->validateLength($productId,1)){
    	$admin->deleteProduct($productId);
    	$userMessage = "Product has been succesfully deleted";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["addCategory"])){
    $categoryName = cleanSQL($_POST ["categoryName"]);
    if ($validator->validateLength($categoryName,3)) {
    	$admin->addCategory($categoryName);
        $userMessage = "Category Has Beed Added Successfully";
    } else {
        $userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["editCategory"])){
    $categoryId = cleanSQLNationalId($_POST ["categoryId"]);
    $categoryName = cleanSQL($_POST ["categoryName"]);
    if($validator->validateLength($categoryName, 3)){
    	$admin->editCategory($categoryId, $categoryName);
    	$userMessage = "Category Has Beed Edited Successfully";
    } else {
    	$userMessage = $validator->getLastErrorMessage();
    }
} 
else if (isset($_POST ["deleteCategory"])) {
	if(isset($_POST ["categoryId"])){
		$categoryId = cleanSQLNationalId($_POST ["categoryId"]);
		if ($validator->validateLength($categoryId, 1)){
			$admin->deleteCategory($categoryId);
			$userMessage = "Category Has Beed Deleted Succesfully";
		} else {
			$userMessage = $validator->getLastError();
		}
	} else {
		$userMessage = "Category Id Can't be empty";
	}
	
   

}
else if (isset($_POST ["addSubCategory"])) {
    $subName = cleanSQL($_POST['subName']);
    $categoryId = cleanSQLNationalId($_POST["categoryId"]);
    if($validator->validateLength($subName, 3) &&
    	$validator->validateLength($categoryId,1)){
    	$admin->addSubCategory($subName, $categoryId);
        $userMessage = "SubCategory Has been Added Successfully";
    } else {
        $userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["editSubCategory"])) {
	$subId = cleanSQLNationalId($_POST ["subId"]);
	$subName = cleanSQL($_POST ["subName"]);
    if($validator->validateLength($subName, 3) &&
    	$validator->validateLength($subId,1)){
    	$admin->editSubCategory($subId, $subName);
    	$userMessage = "SubCategory Has been Edited Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["deleteSubCategory"])){
    $subId = cleanSQLNationalId($_POST ["subId"]);
    if($validator->validateLength($subId, 1)){
    	$admin->deleteSubCategory($subId);
    	$userMessage = "SubCategory was deleted successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["addSubSubCategory"])){
    $subSubName = cleanSQL($_POST ["subSubName"]);
    $subId = cleanSQLNationalId($_POST ["subId"]);
    if($validator->validateLength($subSubName, 3) &&
    		$validator->validateLength($subId, 1)){
    	$admin->addSubSubCategory($subSubName, $subId);
        $userMessage = "SubSubCategory Has been Added Successfully";
    } else {
        $userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["editSubSubCategory"])) {
    $subSubId = cleanSQLNationalId($_POST ["subSubId"]);
    $subSubName = cleanSQL($_POST ["subSubName"]);
    if($validator->validateLength($subSubName, 3) &&
    		$validator->validateLength($subSubId, 1)){
    	$admin->editSubSubCategory($subSubId, $subSubName);
    	$userMessage = "SubSubCategory Has been Edited Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["deleteSubSubCategory"])) {
    $subSubId = cleanSQLNationalId($_POST ["subSubId"]);
    if($validator->validateLength($subSubId, 1)){
    	$admin->deleteSubSubCategory($subSubId);
    	$userMessage = "SubSubCategory was deleted Succesfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["addEditOffer"])) {
    $productId = cleanSQLNationalId($_POST ["productId"]);
    $productDiscount = cleanSQLNationalId($_POST ["productDiscount"]);
    if($validator->validateLength($productId,1) &&
    	$validator->validateOffer($productDiscount)){
    	$admin->setOffer($productId,$productDiscount);
    	$userMessage = "Successfully Added/Edited Offer";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["deleteOffer"])) {
    $productId = cleanSQLNationalId($_POST ["productId"]);
    $productDiscount = 0;
    if($validator->validateLength($productId, 1)){
    	$admin->setOffer($productId,$productDiscount);
    	$userMessage = "Successfully Deleted Offer";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["aproveADS"])) {
    $adsId = cleanSQLNationalId($_POST ["adsId"]);
    $admin->approveAds($adsId);
    $userMessage = "Ads Has been successfully Approved";
} 
else if (isset($_POST ["blockUser"])) {
    $userId = cleanSQLNationalId($_POST ["userId"]);
    if($validator->validateLength($userId, 1)){
    	$admin->blockUser($userId);
    	$userMessage = "Successfully Blocked the User";
    } else {
    	$userMessage =  $validator->getLastError();
    }
} 
else if (isset($_POST ["unBlockUser"])) {
    $userId = cleanSQLNationalId($_POST ["userId"]);
    if($validator->validateLength($userId, 1)){
    	$admin->unBlockUser($userId);
    	$userMessage = "Successfully UnBlocked the User";
    } else {
    	$userMessage = $validator->getLastError();
    }
} 
else if (isset($_POST ["approveProduct"])) {
    $productId = cleanSQLNationalId($_POST ["productId"]);
    if($validator->validateLength($productId, 1)){
    	$admin->approveProduct($productId);
    	$userMessage = "Product Approved Successfully";
    } else {
    	$userMessage = $validator->getLastError();
    }
}
else if(isset($_POST['setColor'])){
	$color = cleanSQL($_POST ["favcolor"]);
	if($validator->validateLength($color, 3)){
		$admin->setColor($color);
		$userMessage = "Color Updated Successfully";
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
            window.location.href = 'index.php';
        }, 500);
    </script>
</html>