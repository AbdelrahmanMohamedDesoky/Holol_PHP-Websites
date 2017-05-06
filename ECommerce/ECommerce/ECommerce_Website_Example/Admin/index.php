<?php
require("AdminLoginCheck.php");
if (! isset ( $_SESSION )) {
	session_start ();
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
	<div class="pusher">
		<!--***********************************
							MODALS SECTION
				************************************-->

		<div id="modals">
			<!-- ***********************
							Sign In Modal
					************************ -->
			<div id="sign-in-modals">
				<div class="ui modal small sign-in-modal">
					<div class="header">Sign In</div>
					<div class="content">
						<form action="">
							<input type="text" value="" placeholder="Email"> <input
								type="password" value="" placeholder="Password">
							<p>
								<input type="checkbox">Remmember me
							</p>
						</form>
						<button>
							<i class="fa fa-facebook" aria-hidden="true"></i>Sign in with
							facebook
						</button>
					</div>
					<div class="actions">
						<div class="ui approve button">Sign In</div>
						<div class="ui cancel button">Cancel</div>
					</div>
				</div>
			</div>

			<!-- ***********************
							Sign UP Modal
					************************ -->
			<div id="sign-up-modals">
				<div class="ui modal small sign-up-modal">
					<div class="header">Sign Up</div>
					<div class="content">
						<form action="">
							<input type="text" value="" placeholder="Username *"> <input
								type="text" value="" placeholder="Email *"> <input
								type="password" value="" placeholder="Password *"> <input
								type="password" value="" placeholder="Confirm Password *"> <input
								type="text" value="" placeholder="National ID *">
							<p>
								<input type="checkbox">Remmember me
							</p>
						</form>
						<button>
							<i class="fa fa-facebook" aria-hidden="true"></i>Sign up with
							facebook
						</button>
					</div>
					<div class="actions">
						<div class="ui approve button">Sign Up</div>
						<div class="ui cancel button">Cancel</div>
					</div>
				</div>
			</div>
		</div>


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
							<li><a href="../index.php">Home</a></li>
							<li><a href="./about.php">About</a></li>
							<li><a href="./contact-us.php">Contact Us</a></li>
							<li><select>
									<option value="eng" onchange="updateLanguage(this.value);">EU</option>
									<option value="ara" onchange="updateLanguage(this.value);">Ar</option>
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
						<img src="http://placehold.it/180x100/4347d2/ffffff?text=LOGO"
							alt="">
					</div>

					<!--***********************************
										NVBAR CONTENT SECTION
								************************************-->

					<div id="nav-content" class="float-left">

						<div id="nav-regester" class="float-left">
							<ul>
												<?php
												$username = $_SESSION ['username'];
												echo "<li><a href='../user-profile.php'>$username</a></li>";
												echo "<li><a href='../logout.php'>Logout</a></li>";
												?>
											</ul>
						</div>

						<div id="search-input" class="float-left"></div>

						<div id="nav-card" class="float-left"></div>

						<div id="categ-menu"></div>

					</div>
					<div style="clear: both;"></div>
				</div>
				<!-- CONTAINER END -->
			</div>
			<!-- NAVBAR BOTTOM END -->

		</nav>
		<!-- NAVBAR END -->


		<!--***********************************
							admin-profile SECTION
				************************************-->
		<div class="profile">
			<div class="container2">

				<div id="tabs">
					<!-- 
	1- Add Product 
	2- Edit Product
	3- Delete Product
	4- Add Main Category
	5- Edit Main Category
	6- Delete Main Category
	7- Add Sub Category
	8- Delete Sub Category
	9- Edit Sub Category
	10- Add Sub Sub Category
	11- Edit Sub Sub Category
	12- Delete Sub Sub Category
	13- Add Offer(Discount)
	14- Edit Offer(Discount)
	15- Delete Offer(Discount)
	16- Approve Ads
	17- Block User
	18- Unblock User
	
	
	-->
					<div id="tab">
						<ul>
							<li><a href="#tabs-1">Add Product</a></li>
							<li><a href="#tabs-2">Edit Product</a></li>
							<li><a href="#tabs-3">Delete Product</a></li>
							<li><a href="#tabs-4">Add Category</a></li>
							<li><a href="#tabs-5">Edit Category</a></li>
							<li><a href="#tabs-6">Delete Category</a></li>
							<li><a href="#tabs-7">Add Sub Category</a></li>
							<li><a href="#tabs-8">Edit Sub Category</a></li>
							<li><a href="#tabs-9">Delete Sub Category</a></li>
							<li><a href="#tabs-10">Add S. S. Category</a></li>
							<li><a href="#tabs-11">Edit S. S. Category</a></li>
							<li><a href="#tabs-12">Delete S. S. Category</a></li>
							<li><a href="#tabs-13">Add / edit Offer</a></li>
							<li><a href="#tabs-15">Delete Offer(Discount)</a></li>
							<li><a href="#tabs-16">Approve Product</a></li>
							<li><a href="#tabs-20">Approve Ads</a></li>
							<li><a href="#tabs-17">Block User</a></li>
							<li><a href="#tabs-18">Unblock User</a></li>
							<li><a href="#tabs-19">Change Website Color</a></li>
						</ul>
					</div>


					<!--- SELECT  `productName`, `productCompany`, `productPrice`, `productDiscount`, 
  `productDescription`,  `productQuantity, `productPicture`, `subId`-->

					<!-- Add product -->
					<div id="tabs-1">
						<div class="add-post">
							<form method="post" action="AdminAction.php"
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

					<!-- Edit product -->
					<div id="tabs-2">
						<div class="add-offer">
							<form action="showProduct.php" method="post">
								<label>Edit product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <input
									type="submit" value="Edit product" name="editProduct">
							</form>
						</div>

					</div>

					<!-- Delete Product-->
					<div id="tabs-3">
						<div class="add-offer">
							<form action="showproduct.php" method="post">
								<label>Delete product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <input
									type="submit" value="Delete product" name="deleteProduct">
							</form>
						</div>
					</div>

					<!-- add  category -->
					<div id="tabs-4">
						<div class="add-category">
							<form action="AdminAction.php" method="post">
								<label>Category Name :</label> <input type="text"
									name="categoryName" placeholder="Category name"> <br> <br> <input
									type="submit" name="addCategory" value="Add Category">
							</form>
						</div>
					</div>

					<!-- edit  category -->
					<div id="tabs-5">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Category :</label> <select name="categoryId"> 
             					<?php
																		$user = new User ();
																		$result = $user->getCategories ();
																		while ( $row = $result->fetch_assoc () ) {
																			$categoryName = $row ['categoryName'];
																			$catId = $row ['categoryId'];
																			echo "<option value='$catId'>$categoryName</option>";
																		}
																		?>
								</select> <br> <br> <input type="text" placeholder="new name"
									name="categoryName"><br> <br> <input type="submit"
									value="Edit Category" name="editCategory">
							</form>
						</div>
					</div>

					<!-- delete Category -->
					<div id="tabs-6">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Category :</label> <select name="categoryId"> 
             					<?php
																		$user = new User ();
																		$result = $user->getCategories ();
																		while ( $row = $result->fetch_assoc () ) {
																			$categoryName = $row ['categoryName'];
																			$catId = $row ['categoryId'];
																			echo "<option value='$catId'>$categoryName</option>";
																		}
																		?>
								</select> <br> <br> <input type="submit" value="Delete Category"
									name="deleteCategory">
							</form>
						</div>
					</div>

					<!-- add sub category -->
					<div id="tabs-7">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Category :</label> <select name="categoryId"> 
             										<?php
																							$user = new User ();
																							$result = $user->getCategories ();
																							while ( $row = $result->fetch_assoc () ) {
																								$categoryName = $row ['categoryName'];
																								$catId = $row ['categoryId'];
																								echo "<option value='$catId'>$categoryName</option>";
																							}
																							?>
		 </select> <br> <br> <input type="text"
									placeholder="sub Category name" name="subName"><br> <br> <input
									type="submit" value="Add sub Category" name="addSubCategory">
							</form>
						</div>
					</div>

					<!-- edit sub category -->
					<div id="tabs-8">

						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label>Choose sub Category :</label> <select name="subId"> 
             										<?php
																							$user = new User ();
																							$result = $user->getSubCategories ();
																							while ( $row = $result->fetch_assoc () ) {
																								$subName = $row ['subName'];
																								$subId = $row ['subId'];
																								echo "<option value='$subId'>$subName</option>";
																							}
																							?> 
											</select><br> <br> <input type="text"
									placeholder="new Sub Name" name="subName"><br> <br> <input
									type="submit" value="Edit Sub Category" name="editSubCategory">
							</form>
						</div>
					</div>

					<!-- Delete sub category  -->
					<div id="tabs-9">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label>Choose sub Category :</label> <select name="subId"> 
             										<?php
																							$user = new User ();
																							$result = $user->getSubCategories ();
																							while ( $row = $result->fetch_assoc () ) {
																								$subName = $row ['subName'];
																								$subId = $row ['subId'];
																								echo "<option value='$subId'>$subName</option>";
																							}
																							?> 
											</select> <br> <br> <input type="submit"
									value="delete Sub Category" name="deleteSubCategory">
							</form>
						</div>
					</div>

					<!--   Add sub sub Category -->
					<div id="tabs-10">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Choose Sub Category :</label> <select name="subId">
									<!-- show  sub data -->
             										<?php
																							$admin = new Admin ();
																							$result = $admin->getSubCategories ();
																							while ( $row = $result->fetch_assoc () ) {
																								$subName = $row ['subName'];
																								$subId = $row ['subId'];
																								echo "<option value='$subId'>$subName</option>";
																							}
																							?>
	 				</select> <br> <br> <input type="text"
									placeholder="sub sub Category name" name="subSubName"><br> <br>
								<input type="submit" value="Add sub Category"
									name="addSubSubCategory">
							</form>
						</div>
					</div>

					<!--   Edit sub sub Category -->
					<div id="tabs-11">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Choose SubSub Category: </label> <select name="subSubId">
									<!-- show  sub data -->
             										<?php
																							$admin = new Admin ();
																							$result = $admin->getSubSubCateogories ();
																							while ( $row = $result->fetch_assoc () ) {
																								$subSubName = $row ['subSubName'];
																								$subSubId = $row ['subSubId'];
																								echo "<option value='$subSubId'>$subSubName</option>";
																							}
																							?>
	 							</select> <br> <br> <input type="text"
									placeholder="S S Category name" name="subSubName"><br> <br> <input
									type="submit" value="Edit Sub Sub Category"
									name="editSubSubCategory">
							</form>
						</div>
					</div>

					<!--  Delete Sub Sub Category -->
					<div id="tabs-12">
						<div class="add-offer">
							<form action="AdminAction.php" method="post">
								<label> Choose Sub Sub Category :</label> <select
									name="subSubId">
									<!-- show  sub data -->
             										<?php
													$admin = new Admin ();
													$result = $admin->getSubSubCateogories ();
													while ( $row = $result->fetch_assoc () ) {
														$subSubName = $row ['subSubName'];
														$subSubId = $row ['subSubId'];
														echo "<option value='$subSubId'>$subSubName</option>";
													}
													?>
	 							</select> <br> <br> <input type="submit"
									value="Delete S. S. Category" name="deleteSubSubCategory">
							</form>
						</div>
					</div>

					<!--  Add offer -->
					<div id="tabs-13">
						<div class="add-offer">
							<form action="showproduct.php" method="post">
								<label> product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <label>Discount</label>
								<input type="number" name="productDiscount"
									placeholder="enter the % discount" class="add-price"> <br> <br>
								<input type="submit" value="Add/Edit Offer" name="addEditOffer">
							</form>
						</div>
					</div>

					<!-- Delete offer -->
					<div id="tabs-15">
						<div class="add-offer">
							<form action="showproduct.php" method="post">
								<label> product</label> <input type="text"
									placeholder="productName" name="productName"><br> <br> <input
									type="submit" value="delete Offer" name="deleteOffer">
							</form>
						</div>
					</div>

					<!-- abrove ADS -->
					<div id="tabs-16">
						<input type="submit" value="Show UnApproved Products"
							onclick="location.href='showproduct.php?type=0';">
					</div>

					<!-- block user -->
					<div id="tabs-17">
						<input type="submit" value="Show Users"
							onclick="location.href='showusers.php?type=1';">
					</div>


					<!-- unblock user -->
					<div id="tabs-18">
						<input type="submit" value="Show Users"
							onclick="location.href='showusers.php?type=2';">
					</div>

					<div id="tabs-19">
						<form action="AdminAction.php" method="post">
							Select your favorite color: <input type="color" name="favcolor"
								value="<?php $user = new User();echo $user->getColor();?>"> <input type="submit" name="setColor">
						</form>
					</div>
					<div id="tabs-20">
						<input type="submit" value="Show UnApproved Ads"
							onclick="location.href='showADS.php';">
					</div>

				</div>
			</div>
		</div>
		<div class="clearfix"></div>


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
        xmlhttp.open("GET","../getSubCategories.php?categoryId="+str,true);
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
        xmlhttp.open("GET","../getSubSubCategories.php?subId="+str,true);
        xmlhttp.send();
    }
}
</script>
	<script src="js/jquery.min.js"></script>
	<!-- Jquery Mini file -->
	<script src="js/wow.min.js"></script>
	<!-- WOW.js Mini file -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Owl-Carousel.js Mini file -->
	<script>new WOW().init();</script>
	<!-- Activate WOW.js File -->
	<script src="js/semantic.min.js"></script>
	<!-- semantic Js File -->
	<script src="js/script.js"></script>
	<!-- Externa Js File file - My File -->
	<script src="js/jquery-1.12.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/custom.js">

</script>
</body>
</html>
