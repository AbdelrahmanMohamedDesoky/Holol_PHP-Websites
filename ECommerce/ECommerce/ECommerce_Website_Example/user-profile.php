<?php
require('loginCheck.php');
require_once('Validation.php');
$validator = new Validation();
$username = $_SESSION ['username'];
$myUser = new User ();
$result = $myUser->getUsernameInfo ( $username );
$resultRow = $result->fetch_assoc ();
$email = $resultRow ['email'];
$userType = $resultRow ['userType'];
$nationalId = $resultRow ['nationalId'];

if (isset ( $_POST ['editEmail'] )) {
	$email = cleanSQL($_POST ['email']);
	if ($validator->validateEmail($email)) {
		$myUser->editEmail ( $username, $email );
		$userMessage = "Email Has been Updated";
	} else {
		$userMessage = $validator->getLastError();
	}
} else if (isset ( $_POST ['editPassword'] )) {
	$password = $_POST ['password'];
	$password_confirm = $_POST ['password_confirm'];
	if ($password != $password_confirm) {
		$userMessage = "Passwords Doesn't Match";
	}
	else if (!$validator->validateLength($password, 6)){
		$userMessage = $validator->getLastError();
	}
	else if (!$validator->validateLength($password_confirm, 6)){
		$userMessage = $validator->getLastError();
	}
	else {
		$password = md5 ( $password );
		if ($myUser->editPassword ( $username, $password )) {
			$userMessage = "Password Has been Updated";
		} else {
			$userMessage = $myUser->getLastErrorMessage();
		}
	}
} else if (isset ( $_POST ['editImg'] )) {
	if($validator->validateImage($_FILES)){
		$imgTemp = $_FILES ['img'] ['tmp_name'];
		if ($myUser->updateUserImage ( $username, $imgTemp )) {
			$userMessage = "Image Has been Updated";
		} else {
			$userMessage = "Error has occured while uploading the image";
		}
	} else {
		$userMessage = $validator->getLastError();
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- IE Combitability Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Mobile First Meta -->
<meta name="viewport" content="width=device-width, initial-scale=1">


<title>E-Commerce | Home</title>

<link rel="stylesheet" href="css/semantic.min.css">
<!-- semantic.css File -->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<!-- font awesome.css file -->
<link rel="stylesheet" href="css/animate.css">
<!-- Animate.CSS File -->
<link rel="stylesheet" href="css/owl.carousel.css">
<!-- Owl Carousel.CSS File -->
<link href="css/hover.css" rel="stylesheet" media="all">
<!-- Hover.CSS File -->
<link rel="stylesheet" href="css/style.css">
<!-- CSS File -->
<link rel="stylesheet" href="css/media.css">
<!-- Media Query File -->
<link
	href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800"
	rel="stylesheet">
<link rel="stylesheet" href="js/jquery-ui.theme.min.css">
<link rel="stylesheet" href="css/styyle.css">


<!-- Font -->
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	        <script src="js/html5shiv.min.js"></script>
	        <script src="js/respond.min.js"></script>
	    	<![endif]-->
</head>
<body>

<div class='ui left vertical menu sidebar'>
                            <div class='ui styled fluid accordion'> <div> <div>
    <!--  first category -->
	<?php
$admin = new Admin;
$result = $admin->categoriesNav();

if ($result->num_rows > 0) {
    // output data of each row
    $lastCatName="";
    $lastsubName="";

    while($row = $result->fetch_assoc()) {

       if ($lastCatName!=$row['categoryName'])
       {
           echo "  </div></div><div class='title'>
				    	<i class='dropdown icon'></i> ";
           echo $row['categoryName']." ";
           echo " </div>
				<div class='content'><div> ";
            $lastCatName=$row['categoryName'];
       }
        if ($lastsubName!=$row['subName'])
       {
       	   $subId = $row['subId'];
       	   $subName = $row['subName'];
           echo "</div> <div class='title'><i class='dropdown icon'></i>  ";
           echo $row['subName']." ";
           echo "</div> <div class='content'>
<p class='transition hidden'> <a style='text-decoration:uderline;' href='viewProductsByCategory.php?subId=$subId'>View $subName Products </a><br>";
            $lastsubName=$row['subName'];
       }
        $subSubName = $row['subSubName'];
        $subSubId = $row['subSubId'];
        echo "<p class='transition hidden'>"."<a style='text-decoration:uderline;' href='viewProductsByCategory.php?subSubId=$subSubId'>$subSubName </a><br>"."</p>";
        $lastCatName=$row['categoryName'];



}
}else {
    echo "No Categories";
}

					?>
                                     </div></div>
				</div>
			</div>

			</div>
			<div class="pusher">
		<!--***********************************
							MODALS SECTION
							We are Inside User-profile no need for signin-signup
				************************************-->

		<!--***********************************
							NAVBAR SECTION
				************************************-->
		<nav id="navbar">

			<!--***********************************
									TOP NAV
						************************************-->
			<div id="top-nav">
				<div class="container">

					<div class="float-left" id="top-nav-left">
						<ul>
							<li><a href=""><span>Phone: </span>+2 0123456789</a></li>
							<li><a href=""><span>E-mail: </span>example@example.com</a></li>
						</ul>
					</div>

					<div class="float-right" id="top-nav-right">
						<ul>
							<li><a href="./index.php">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="./ContactUs.php">Contact Us</a></li>
							<li><select>
									<option value="eng">EU</option>
									<option value="ara">Ar</option>
							</select></li>
						</ul>
					</div>
					<div style="clear: both;"></div>
				</div>
				<!-- CONTAINER END -->
			</div>
			<!-- TOP NAV END -->

			<!--***********************************
									BOTTOM NAV
						************************************-->
			<div id="bottom-nav">
				<div class="container">

					<!--***********************************
											LOGO SECTION
								************************************-->

					<div id="logo" class="float-left">
						    <a href="index.php"><img src="./images/logo.jpg" alt=""></a>
					</div>

					<!--***********************************
										NVBAR CONTENT SECTION
								************************************-->

					<div id="nav-content" class="float-left">

						<div id="nav-regester" class="float-left">
							<ul>
												<?php
												$username = $_SESSION ['username'];
												echo "<li><a href='user-profile.php'>$username</a></li>";
												echo "<li><a href='logout.php'>Logout</a></li>";
												?>
											</ul>
						</div>

																<div id="search-input" class="float-left">
										<form action = './searchResult.php' METHOD='POST'>
										<input type="text" name="productName" placeholder="Search..">
										<input type="submit" name = "Search">
										</form>

										</div>

						<div id="nav-card" class="float-left">
							<a href="./user-profile.php#tabs-4"><i class="fa fa-shopping-cart fa-2x"
								aria-hidden="true"></i></a>
						</div>

						<div id="categ-menu">
                                <a href="#" id="category-menu"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
                            </div>

					</div>
					<div style="clear: both;"></div>
				</div>
				<!-- CONTAINER END -->
			</div>
			<!-- NAVBAR BOTTOM END -->

		</nav>
		<!-- NAVBAR END -->


		<!--***********************************
							user-profile SECTION
				************************************-->
		<div class="profile">
			<div class="container">

				<div id="tabs">
					<div id="tab">
						<ul>
							<li><a href="#tabs-1">Profile</a></li>
							<li><a href="#tabs-2">Edit Profile</a></li>
							<li><a href="#tabs-3">Add Product</a></li>
							<li><a href="#tabs-6">Edit Product</a></li>
							<li><a href="#tabs-7">Delete Product</a></li>
							<li><a href="#tabs-4">Cart</a></li>
							<li><a href="#tabs-5">WishList</a></li>
							<li><a href="#tabs-8">Add/Edit Offer</a></li>
							<li><a href="#tabs-9">Delete Offer</a></li>
							<li><a href="#tabs-10">Show Bought products</a></li>
							<li><a href="#tabs-11">Show Sold products</a></li>

						</ul>
					</div>

					<div id="tabs-1">
						<div class="user-profile">
							<img src="images/<?php echo "$username.jpg"?>"> <br>
							<div id="user-info">
								<div class="lable">
									<p>
										<b>user name:</b> <?php echo $username ?></p>
								</div>
								<div>
									<p>
										<b>E-mail:</b><?php echo $email ?></p>
								</div>
								<div>
									<p>
										<b>ID:</b> <?php echo $nationalId ?></p>
								</div>
							</div>
						</div>
					</div>



					<div id="tabs-2">
						<div id="edit-user">
							<form action='user-profile.php' method="post">
								<label>Email: </label> <input type="email" name="email"
									placeholder="New Email *"> <br> <br> <input type="submit"
									name="editEmail" value="Update Email">
							</form>
							<br> <br>
							<form action='user-profile.php' method="post">
								<label>Password : </label> <input type="password"
									name="password" placeholder="New Password *"> <br> <br> <label>Password
									Confirm : </label> <input type="password"
									name="password_confirm" placeholder="Password Confirm *"> <br>
								<br> <br> <br> <input type="submit" name="editPassword"
									value="Change Password">
							</form>
							<br> <br>
							<form action='user-profile.php' method="post"
								enctype="multipart/form-data">
								<label>Profile Picture : </label> <input type='file' name='img'
									required><br> <br> <br> <br> <input type="submit"
									name="editImg" value="Change Image">
							</form>
						</div>
					</div>


					<div id="tabs-3">
						<div class="add-post">
							<form method="post" action="UserAction.php"
								enctype="multipart/form-data">
								<label>Main Category :</label>
								<div>
									<select name="categoryId"
										onchange="showSubCategories(this.value)">
             					<?php
								echo "<option value=''>Select Category</option>";
								$user = new User ();
								$result = $user->getCategories ();
									while ( $row = $result->fetch_assoc () ) {
										$categoryName = $row ['categoryName'];
										$catId = $row ['categoryId'];
										echo "<option value='$catId'>$categoryName</option>";
										}
								?>
		 							</select> <br> <br>
								</div>
								<label>Sub Categories:</label>
								<div id="subCategories"></div>
								<br> <label>Sub Sub Categories:</label>
								<div id="subSubCategories"></div>
								<br> <label>productName:</label> <input type="text"
									name="productName" placeholder="enter the productName"> <br> <br>
								<label>productCompany:</label> <input type="text"
									name="productCompany" placeholder="enter the productCompany"> <br>
								<br> <label> Product Image : </label> <input type="file"
									name="img"> <br> <br> <label>Description:</label>
								<textarea name="productDescription" class="desp2"
									placeholder="enter the description"></textarea>
								<br> <br> <label>Product Quantity</label> <input type="number"
									name="productQuantity" placeholder="enter product quantity" />
								<br> </br> <label>Price</label> <input type="number"
									name="productPrice" placeholder="enter the price"> <br> <br> <label>Product
									Discount :</label> <input type="number" name="productDiscount"
									placeholder="Discount % Percentage"> <br> <br> </br>
								<center>
									<input type="submit" value="Add Product" name="addProduct">
								</center>
							</form>
						</div>
					</div>


					<div id="tabs-4">
						<div class="cart">
							<table>
								<tr>
									<th>Product Name</th>
									<th>Image</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Update</th>
									<th>Delete</th>
								</tr>

								<?php
								$result = $myUser->getCart();
								while($cartItem = $result->fetch_assoc()){
									$productId = $cartItem['productId'];
									$productName = $cartItem['productName'];
									$productPrice = $cartItem['productPrice'];
									$productDiscount = $cartItem['productDiscount'];
									$productImage = $cartItem['productPicture'];
									$productQuantity = $cartItem['productQuantity'];
									$productRealPrice = ($productPrice - ($productPrice * $productDiscount / 100)) * $productQuantity;
									echo "
										<tr>
									<td>$productName</td>
									<td><img src='images/$productImage.jpg' style='width:100px;height:100px;'></td>
									<td><center><input style='width:70px;' id = 'quantity' type ='number' name = 'productQuantity' value = '$productQuantity'></center></td>
									<td>\$$productRealPrice</td>
									<td><input type='submit' onclick=\"updateQuantity($productId);\" value='Update' class='wishlist'></td>
									<td><input type='submit' onclick=\"location.href='UserAction.php?deleteFromCart=$productId';\" name='deleteItem' value='Delete'
											class='wishlist'></td>
										</tr>
											";
								}
								?>

							</table>
							<input type='submit' onclick="location.href='Cart.php';" value='Check Out!'class='wishlist'>
						</div>
					</div>


					<div id="tabs-5">
						<div class="wishList">
							<table>
								<tr>
									<th>Image</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Action</th>
								</tr>

								<?php
								$result = $user->getWishList();
								while($wishListItem = $result->fetch_assoc()){
									$productId = $wishListItem['productId'];
									$query = "SELECT * FROM product WHERE productId = '$productId';";
									$realResult = $conn->query($query);
									$productRow = $realResult->fetch_assoc();
									$productName = $productRow['productName'];
									$productPrice = $productRow['productPrice'];
									$productDiscount = $productRow['productDiscount'];
									$productImage = $productRow['productPicture'];
									$productRealPrice = ($productPrice - (($productPrice * $productDiscount) / 100));
									echo "
									<td><img src='images/$productImage.jpg' style='width:100px;height:100px;'></td>
									<td>$productName</td>
									<td>\$$productRealPrice</td>
									<td><input type='submit' onclick=\"location.href='UserAction.php?deleteFromWishList=$productId';\" name='deleteItem' value='Delete'
										class='wishlist'></td>
										</tr>
											";
								}
								?>

							</table>
						</div>
					</div>

					<!--  Edit Product -->
					<div id="tabs-6">
						<div class="add-offer">
							<form action = "showProduct.php" method="post" >
								<label>Edit product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <input
									type="submit" value="Edit product" name="editProduct">
							</form>
						</div>
					</div>


					<!--  Delete Product -->
					<div id="tabs-7">
						<div class="add-offer">
							<form action = "showProduct.php" method="post" >
								<label>Delete product : </label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <input
									type="submit" value="Delete Product" name="deleteProduct">
							</form>
						</div>
					</div>

					<div id="tabs-8">
						<div class="add-offer">
							<form action="showproduct.php" method="post">
								<label> product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <label>Discount</label>
								<input type="number" name="productDiscount" placeholder="enter the % discount" class="add-price"> <br> <br>
								<input type="submit" value="Add/Edit Offer" name="addEditOffer">
							</form>
						</div>
					</div>

					<div id="tabs-9">
						<div class="add-offer">
							<form action="showproduct.php" method="post">
								<label> product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br>
								<input type="submit" value="Delete Offer" name="deleteOffer">
							</form>
						</div>
					</div>

				   <!--show bought products -->
					<div id="tabs-10">
						<div class="add-offer">
						<table>
								<tr>
									<th>Image</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Rating</th>
								</tr>
								<?php
								$result = $user->showBoughtProducts();
								while($boughtProductRow = $result->fetch_assoc()){
									$productId = $boughtProductRow['productId'];
									$query = "SELECT * FROM product WHERE productId = '$productId';";
									$realResult = $conn->query($query);
									$productRow = $realResult->fetch_assoc();
									$productName = $productRow['productName'];
									$productPrice = $productRow['productPrice'];
									$productDiscount = $productRow['productDiscount'];
									$productImage = $productRow['productPicture'];
									$productRealPrice = ($productPrice - (($productPrice * $productDiscount) / 100));
									echo "
									<td><img src='images/$productImage.jpg' style='width:100px;height:100px;'></td>
									<td>$productName</td>
									<td>\$$productRealPrice</td>
									<td>
									<select name = 'userRate' id='rate'>
									<option value='1'> 1 </option>
									<option value='2'> 2 </option>
									<option value='3'> 3 </option>
									<option value='4'> 4 </option>
									<option value='5'> 5 </option>
									<input type='submit' onclick=\"rate($productId)\" name='rateProduct' value='Rate Product'
										class='wishlist'>
									</select>
									</td>
										</tr>
											";
								}
								?>
							</table>
						</div>
					</div>

				      <!--show sold products -->
					<div id="tabs-11">
						<div class="add-offer">
													<table>
								<tr>
									<th>Image</th>
									<th>Product Name</th>
									<th>Price</th>
								</tr>
								<?php
								$result = $user->showSoldProducts();
								while($soldProductItem = $result->fetch_assoc()){
									$productId = $soldProductItem['productId'];
									$query = "SELECT * FROM product WHERE productId = '$productId';";
									$realResult = $conn->query($query);
									$productRow = $realResult->fetch_assoc();
									$productName = $productRow['productName'];
									$productPrice = $productRow['productPrice'];
									$productDiscount = $productRow['productDiscount'];
									$productImage = $productRow['productPicture'];
									$productRealPrice = ($productPrice - (($productPrice * $productDiscount) / 100));
									echo "
									<td><img src='images/$productImage.jpg' style='width:100px;height:100px;'></td>
									<td>$productName</td>
									<td>\$$productRealPrice</td>
										</tr>
											";
								}
								?>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>




		<!--***********************************
							FOOTER SECTION
				************************************-->
		<footer id="footer">

			<!--*********************
						  MAIN FOOTER
					**********************-->
			<div id="main-footer">
				<div class="container-fluid">

					<!--*********************
							   popular search sec.
							**********************-->
					<div id="footer-popular-search">
						<h4>popular searches</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
						<h4>LEARNING CENTER</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
					</div>
					<!-- popular sec. end -->


					<!--*********************
							   	my account sec.
							**********************-->
					<div id="footer-my-account">
						<h4>my account</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
						<h4>INTELLECTUAL PROPERTY</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
					</div>
					<!-- my account sec. end -->


					<!--*********************
							   	  selling sec.
							**********************-->
					<div id="footer-selling">
						<h4>selling</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
						<h4>BUYING ON</h4>
						<div class="content">
							<ul>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
								<li><a href="">Link</a></li>
							</ul>
						</div>
					</div>
					<!-- selling sec. end -->


					<!--*********************
							    contact us sec.
							**********************-->
					<div id="footer-contact-us">
						<h4>contact us</h4>
						<div class="content">
							<div id="customer-service" class="contact-block">
								<h4>customer service</h4>
								<p>
									<a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
										contact us</a>
								</p>
								<p>
									Sat - Thu: 9 AM - 9 PM </br> Fri: 1:30 PM - 9 PM
								</p>
							</div>
							<div id="call-to-order" class="contact-block">
								<h4>call to order</h4>
								<p>
									<a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>
										contact us</a>
								</p>
								<p>Daily, 9 AM to 10 PM</p>
							</div>
							<div id="follow-us" class="contact-block">
								<h4>follow us</h4>
								<div class="content">
									<ul>
										<li><a href="#" class="fb-icon"><i
												class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
										<li><a href="#" class="twitter-icon"><i class="fa fa-twitter"
												aria-hidden="true"></i></a></li>
										<li><a href="#" class="google-icon"><i
												class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
										<li><a href="#" class="yu-icon"><i
												class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- contact-us sec. end -->


				</div>
			</div>
			<!-- main-footer end -->


			<!--*********************
						  SMALL FOOTER
					**********************-->
			<div id="small-footer">
				<div class="container">
					<div id="footer-copyright" class="float-left">
						<h5>
							<i class="fa fa-copyright" aria-hidden="true"></i> 2016
							E-commerce.com
						</h5>
					</div>
					<div id="footer-social" class="float-left">
						<ul>
							<li><a href="#">About Us</a></li>
							<li>|</li>
							<li><a href="#">Career</a></li>
							<li>|</li>
							<li><a href="#">Privacy Police</a></li>
							<li>|</li>
							<li><a href="#">Terms and Condetions</a></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- small-footer end -->

		</footer>
		<!-- Footer end -->




	</div>





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
	</script>
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
	function updateQuantity(productId){
		var quantity = document.getElementById('quantity').value;
		window.location.href = 'UserAction.php?updateQuantity&productId='+productId+'&quantity=' + quantity;
	}
	function getRate(){
		var value = document.getElementById('rate').value;
		return value;
	}
	function rate(productId){
	var value = getRate();
	 window.location.href = 'UserAction.php?rateProduct&productId=$productId='+productId+'&userRate=' + value;
	}
	</script>


	<script src="js/jquery.min.js"></script>
	<!-- Jquery Mini file -->
	<script src="js/wow.min.js"></script>
	<!-- WOW.js Mini file -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Owl-Carousel.js Mini file -->

	<!-- Activate WOW.js File -->
<!-- semantic Js File -->
	<script src="js/script.js"></script>
	<!-- Externa Js File file - My File -->
	<script src="js/jquery-1.12.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/semantic.min.js"></script>




</body>
</html>
