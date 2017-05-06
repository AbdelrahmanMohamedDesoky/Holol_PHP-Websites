<!DOCTYPE html>
<html lang="en">
<head>
<title>products</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
require 'User.php';
$user = new User();
if (isset ( $_POST ['editProduct'] )) {
	echo "<div class='container_fluid'>
	<!--<h2>Striped Rows</h2>-->
	<form action ='showProduct.php' method='POST'>
	<table class='table table-striped'>
	<thead>
	<tr>
	<th>productId</th>
	<th>productName</th>
	<th>productCompany</th>
	<th>productPrice</th>
	<th>productDiscount</th>
	<th>productCompany</th>
	<th>productDescription</th>
	<th>productRate</th>
	<th>productQuantity</th>
	<th>approveState</th>
	<th>productPicture</th>
	<th>subName</th>
	<th>subSubName</th>
	<th>sellerName</th>
	</tr>
	</thead>
	<tbody>";
	$productName = $_POST ["productName"];
	$result = $user->showProduct ( $productName );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$productPicture = $row ['productPicture'];
			echo " <tr>
        <td><input type='radio' name='productId' style='width:30px;height:30px;' value='" . $row ['productId'] . "'></td>
        <td>" . $row ['productName'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productPrice'] . "</td>
        <td>" . $row ['productDiscount'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productDescription'] . "</td>
        <td>" . $row ['productRate'] . "</td>
        <td>" . $row ['productQuantity'] . "</td>
        <td>" . $row ['approveState'] . "</td>
	        <td><img src='images/$productPicture.jpg'  style='width:200px;height:200px;'></td>
	        <td>" . $row ['subName'] . "</td>
          <td>" . $row ['subSubName'] . "</td>
           <td>" . $row ['username'] . "</td>
      </tr>";
		}
		echo "
	</tbody>

	</table>
	<center>
		<input class='btn' style='background-color: #4347d2; color: #fff;'
			type='submit' name='viewProductEdit'/>
	</center>
	</form>";
	} else {
		echo "<center><b> No Products Were Found With That Name Go back and try again</b></center>";
		die();
	}
}
else if (isset ( $_POST ['deleteProduct'] )) {
	echo "<div class='container_fluid'>
	<!--<h2>Striped Rows</h2>-->
	<form action ='UserAction.php' method='POST'>
	<table class='table table-striped'>
	<thead>
	<tr>
	<th>productId</th>
	<th>productName</th>
	<th>productCompany</th>
	<th>productPrice</th>
	<th>productDiscount</th>
	<th>productCompany</th>
	<th>productDescription</th>
	<th>productRate</th>
	<th>productQuantity</th>
	<th>approveState</th>
	<th>productPicture</th>
	<th>subName</th>
	<th>subSubName</th>
	<th>sellerName</th>
	</tr>
	</thead>
	<tbody>";
	$productName = $_POST["productName"];
	$result = $user->showProduct($productName);
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$productPicture = $row ['productPicture'];
			echo " <tr>
        <td><input type='radio' name='productId' style='width:30px;height:30px;' value='" . $row ['productId'] . "'></td>
        <td>" . $row ['productName'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productPrice'] . "</td>
        <td>" . $row ['productDiscount'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productDescription'] . "</td>
        <td>" . $row ['productRate'] . "</td>
        <td>" . $row ['productQuantity'] . "</td>
        <td>" . $row ['approveState'] . "</td>
        <td><img src=images/$productPicture.jpg  style='width:200px;height:200px;'></td>
        <td>" . $row ['subName'] . "</td>
          <td>" . $row ['subSubName'] . "</td>
           <td>" . $row ['username'] . "</td>
      </tr>";
		}
		echo "
	</tbody>

	</table>
	<center>
		<input class='btn' style='background-color: #4347d2; color: #fff;'
			type='submit' name='deleteProduct'/>
	</center>
	</form>";
	} else {
		echo "<center><b> No Products Were Found With That Name Go back and try again</b></center>";
		die();
	}
}
else if (isset ( $_POST ['addEditOffer'] )) {
	echo "<div class='container_fluid'>
	<!--<h2>Striped Rows</h2>-->
	<form action ='UserAction.php' method='POST'>
	<table class='table table-striped'>
	<thead>
	<tr>
	<th>productId</th>
	<th>productName</th>
	<th>productCompany</th>
	<th>productPrice</th>
	<th>productDiscount</th>
	<th>productCompany</th>
	<th>productDescription</th>
	<th>productRate</th>
	<th>productQuantity</th>
	<th>approveState</th>
	<th>productPicture</th>
	<th>subName</th>
	<th>subSubName</th>
	<th>sellerName</th>
	</tr>
	</thead>
	<tbody>";
	$productName = $_POST ["productName"];
	$productDiscount = $_POST['productDiscount'];
	$result = $user->showProduct ( $productName );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$productPicture = $row ['productPicture'];
			echo " <tr>
        <td><input type='radio' name='productId' style='width:30px;height:30px;' value='" . $row ['productId'] . "'></td>
        <td>" . $row ['productName'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productPrice'] . "</td>
        <td>" . $row ['productDiscount'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productDescription'] . "</td>
        <td>" . $row ['productRate'] . "</td>
        <td>" . $row ['productQuantity'] . "</td>
        <td>" . $row ['approveState'] . "</td>
        <td><img src=images/$productPicture.jpg  style='width:200px;height:200px;'></td>
        <td>" . $row ['subName'] . "</td>
          <td>" . $row ['subSubName'] . "</td>
           <td>" . $row ['username'] . "</td>
      </tr>";
		}
		echo "
	</tbody>

	</table>
	<center>
        <input type ='hidden' name = 'productDiscount' value = '$productDiscount'>
		<input class='btn' style='background-color: #4347d2; color: #fff;'
			value = 'Add/Edit Offer' type='submit' name='addEditOffer'/>
	</center>
	</form>";
	} else {
		echo "<center><b> No Products Were Found With That Name Go back and try again</b></center>";
		die();
	}
}
else if (isset ( $_POST ['deleteOffer'] )) {
	echo "<div class='container_fluid'>
	<!--<h2>Striped Rows</h2>-->
	<form action ='UserAction.php' method='POST'>
	<table class='table table-striped'>
	<thead>
	<tr>
	<th>productId</th>
	<th>productName</th>
	<th>productCompany</th>
	<th>productPrice</th>
	<th>productDiscount</th>
	<th>productCompany</th>
	<th>productDescription</th>
	<th>productRate</th>
	<th>productQuantity</th>
	<th>approveState</th>
	<th>productPicture</th>
	<th>subName</th>
	<th>subSubName</th>
	<th>sellerName</th>
	</tr>
	</thead>
	<tbody>";
	$productName = $_POST ["productName"];
	$result = $user->showProduct ( $productName );
	if ($result->num_rows > 0) {
		// output data of each row
		while ( $row = $result->fetch_assoc () ) {
			$productPicture = $row ['productPicture'];
			echo " <tr>
        <td><input type='radio' name='productId' style='width:30px;height:30px;' value='" . $row ['productId'] . "'></td>
        <td>" . $row ['productName'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productPrice'] . "</td>
        <td>" . $row ['productDiscount'] . "</td>
        <td>" . $row ['productCompany'] . "</td>
        <td>" . $row ['productDescription'] . "</td>
        <td>" . $row ['productRate'] . "</td>
        <td>" . $row ['productQuantity'] . "</td>
        <td>" . $row ['approveState'] . "</td>
        <td><img src=images/$productPicture.jpg  style='width:200px;height:200px;'></td>
        <td>" . $row ['subName'] . "</td>
          <td>" . $row ['subSubName'] . "</td>
           <td>" . $row ['username'] . "</td>
      </tr>";
		}
		echo "
		</tbody>

		</table>
		<center>
		<input class='btn' style='background-color: #4347d2; color: #fff;'
		value = 'Delete Offer' type='submit' name='deleteOffer'/>
		</center>
		</form>";
	} else {
		echo "<center><b> No Products Were Found With That Name Go back and try again</b></center>";
		die();
	}
}
else if(isset($_POST['viewProductEdit']) && !empty($_POST['productId'])) {
	$productId = $_POST ['productId'];
	$result = $user->getProduct( $productId );
	$row = $result->fetch_assoc();
	$productName = $row ['productName'];
	$productCompany = $row ['productCompany'];
	$productPrice = $row ['productPrice'];
	$productDiscount = $row ['productDiscount'];
	$productQuantity = $row ['productQuantity'];
	$productDescription = $row ['productDescription'];
	echo "<form method='post' action = 'UserAction.php' enctype='multipart/form-data'>";
	$user = new User ();
	echo 					" <br>
								<label>productName:</label> <input type='text' name='productName' placeholder='enter the productName' value ='$productName'> <br> <br>
								<label>productCompany:</label> <input type='text' name='productCompany' value = '$productCompany' placeholder='enter the productCompany'> <br>
								<br>
								<label> Product Image : </label> <input type='file' name='img'> <br> <br>
								<label>Description:</label>
								<textarea name='productDescription' class='desp2' placeholder='enter the description'>$productDescription</textarea>
								<br> <br>
								<label>Product Quantity</label> <input type='number' name='productQuantity' value='$productQuantity' placeholder='enter product quantity' /> <br> </br>
								<label>Price</label> <input
									type='number' name='productPrice' value = '$productPrice' placeholder='enter the price'> <br>
								<br>
								<label>Product Discount :</label> <input
									type='number' name='productDiscount' value = '$productDiscount' placeholder='Discount % Percentage'> <br>
								<br>
								<input type='hidden' name='productId' value='$productId'>
								</br><center><input type='submit' value='Update Product' name='editProduct'></center>
							</form>";
}
?>
</div>
</body>
<script>
function showSubCategories(str) {
    if (str == "") {
        document.getElementById("subCategories").innerHTML = "";
        document.getElementById("subSubCategories").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("subCategories").innerHTML = xmlhttp.responseText;
                document.getElementById("subSubCategories").innerHTML = "";
            }
        };
        xmlhttp.open("GET","getSubCategories.php?categoryId="+str,true);
        xmlhttp.send();
    }
}
function showSubSubCategories(str) {
    if (str == "") {
        document.getElementById("subSubCategories").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("subSubCategories").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","getSubSubCategories.php?subId="+str,true);
        xmlhttp.send();
    }
}
</script>
</html>
