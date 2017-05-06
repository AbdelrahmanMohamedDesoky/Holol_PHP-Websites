<?php
if(!isset($_SESSION)){
	session_start();
}
require_once("./Admin.php");
$admin = new Admin();
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

					 <title>ECommerce - View Product</title>

			<link rel="stylesheet" href="css/semantic.min.css"> <!-- semantic.css File -->
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!-- font awesome.css file -->
			<link rel="stylesheet" href="css/animate.css"> <!-- Animate.CSS File -->
			<link rel="stylesheet" href="css/owl.carousel.css"> <!-- Owl Carousel.CSS File -->
			<link href="css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
			<link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
			<link rel="stylesheet" href="css/media.css"> <!-- Media Query File -->
			<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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
						    	<input type="text" value="" placeholder="Email">
						    	<input type="password" value="" placeholder="Password">
								<p><input type="checkbox">Remmember me</p>
						    </form>
							<button><i class="fa fa-facebook" aria-hidden="true"></i>Sign in with facebook</button>
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
								<input type="text" value="" placeholder="Username *">
						    	<input type="text" value="" placeholder="Email *">
						    	<input type="password" value="" placeholder="Password *">
								<input type="password" value="" placeholder="Confirm Password *">
								<input type="text" value="" placeholder="National ID *">
								<p><input type="checkbox">Remmember me</p>
						    </form>
							<button><i class="fa fa-facebook" aria-hidden="true"></i>Sign up with facebook</button>
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

								<div class="float-left"id="top-nav-left">
									<ul>
										<li><a href=""><span>Phone: </span>+2 0123456789</a></li>
										<li><a href=""><span>E-mail: </span>example@example.com</a></li>
									</ul>
								</div>

								<div class="float-right" id="top-nav-right">
									<ul>
										<li><a href="./index.php">Home</a></li>
										<li><a href="./about.php">About</a></li>
										<li><a href="./contact-us.php">Contact Us</a></li>
										<li>
											<select>
												<option value="eng">EU</option>
												<option value="ara">Ar</option>
											</select>
										</li>
									</ul>
								</div>
								<div style="clear:both;"></div>
							</div> <!-- CONTAINER END -->
						</div> <!-- TOP NAV END -->

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
												if(isset($_SESSION['username'])){
													$username = $_SESSION['username'];
													echo "<li><a href='./user-profile.php'>$username</a></li>";
												} else {
													echo "<li><a href='#'>Welcome Guest</a></li>";
												}
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
											<a href="./Cart.php"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
										</div>

										<div id="categ-menu">
											<a href="#" id="category-menu"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>
										</div>

								</div>
								<div style="clear:both;"></div>
							</div> <!-- CONTAINER END -->
						</div><!-- NAVBAR BOTTOM END -->

				</nav><!-- NAVBAR END -->


				<!--***********************************
							about SECTION
				************************************-->

				<div class="container" style="margin:30px;border:2px solid orange;padding:0px;">
				   <?php
					 if(isset($_GET['id'])){
						 if(!empty(cleanSQLNationalId($_GET['id']))){
							 $productId = cleanSQLNationalId($_GET['id']);
						 } else {
							 $productId = -1;
						 }
					 } else {
						 $productId = -1;
					 }
				   $result = $admin->getProduct($productId);
				   if($result->num_rows > 0){
				   	$productRow = $result->fetch_assoc();
				   		$productId = $productRow['productId'];
				   		$productName = $productRow['productName'];
				   		$productCompany = $productRow['productCompany'];
				   		$productPrice = $productRow['productPrice'];
				   		$productDiscount = $productRow['productDiscount'];
				   		$productQuantity = $productRow['productQuantity'];
				   		$productDescription = $productRow['productDescription'];
				   		$productPicture = $productRow['productPicture'];
				   		$productRate = $productRow['productRate'];
				   		$productRealPrice = ($productPrice - (($productPrice * $productDiscount) / 100));
				   		$sellerName = $productRow['username'];
				   		echo "
					 <div class='col-lg-5' style='background-color:#ededed;height:310px;'>
					   <img src='./images/$productPicture.jpg' style='width:100%;height:310px;'>
					</div>

				<div class='col-lg-5' style='background-color:#ededed;height:310px'>
					   <table class='table table-striped' style='width:100%;'>


						<tr>
                           <th><span style='color:#4347d2;'>Name:</span>$productName</th>
						</tr>

						<tr>
                           <th><span style='color:#4347d2;'>Company:</span>$productCompany</th>
						   </tr>

						<tr>
                            <th><span style='color:#4347d2;'>Price:</span>$$productRealPrice</th>
							</tr>

						<tr>
                            <th><span style='color:#4347d2;'>Discount:</span>%$productDiscount</th>
							</tr>

						<tr>
                            <th><span style='color:#4347d2;'>Available Quantity:</span>$productQuantity</th>
							</tr>

						<tr>
                            <th><span style='color:#4347d2;'>Description:</span>$productDescription</th>
							</tr>

						<tr>
                            <th><span style='color:#4347d2;'>Rate:</span>$productRate</th>
							</tr>
						<tr>
                            <th><span style='color:#4347d2;'>Seller :</span>$sellerName</th>
							</tr>
					   </table>
					</div>
					<div class='col-lg-2' style='background-color:#ededed;height:310px;'>";

					if(isset($_SESSION['username'])){
						echo "						 <input type='submit'  style ='margin-top:100px;' class='btn' name='addToCart' value='Add To Cart' onclick=\"location.href='UserAction.php?addToCart&productId=$productId'\">
						 <input type='submit'  style ='margin-top:20px;' class='btn' name='addToWishList' value='Add to WishList' onclick=\"location.href='UserAction.php?addWishList=$productId'\">";
					}

					echo "</div>";
				   } else {
				   	echo "No Products Were Found";
				   }

				   ?>

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
							</div> <!-- popular sec. end -->


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
							</div> <!-- my account sec. end -->


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
							</div><!-- selling sec. end -->


							<!--*********************
							    contact us sec.
							**********************-->
							<div id="footer-contact-us">
								<h4>contact us</h4>
								<div class="content">
									<div id="customer-service" class="contact-block">
										<h4>customer service</h4>
										<p><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> contact us</a></p>
										<p>Sat - Thu: 9 AM - 9 PM </br> Fri: 1:30 PM - 9 PM</p>
									</div>
									<div id="call-to-order" class="contact-block">
										<h4>call to order</h4>
										<p><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> contact us</a></p>
										<p>Daily, 9 AM to 10 PM</p>
									</div>
									<div id="follow-us" class="contact-block">
										<h4>follow us</h4>
										<div class="content">
											<ul>
												<li><a href="#" class="fb-icon"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
												<li><a href="#" class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
												<li><a href="#" class="google-icon"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
												<li><a href="#" class="yu-icon"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div> <!-- contact-us sec. end -->


						</div>
					</div> <!-- main-footer end -->


					<!--*********************
						  SMALL FOOTER
					**********************-->
					<div id="small-footer">
						<div class="container">
							<div id="footer-copyright" class="float-left">
								<h5> <i class="fa fa-copyright" aria-hidden="true"></i> 2016 E-commerce.com</h5>
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
					</div> <!-- small-footer end -->

				</footer> <!-- Footer end -->




			</div>







			  <script src="js/jquery.min.js"></script> <!-- Jquery Mini file -->
			  <script src="js/wow.min.js"></script> <!-- WOW.js Mini file -->
			  <script src="js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
			  <script>new WOW().init();</script> <!-- Activate WOW.js File -->
			  <script src="js/semantic.min.js"></script> <!-- semantic Js File -->
			  <script src="js/script.js"></script> <!-- Externa Js File file - My File -->

        </body>
    </html>
