<?php
require_once('loginCheck.php');
require_once('Admin.php');
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

					 <title>E-Commerce | Thanks for your payment</title>

			<link rel="stylesheet" href="css/semantic.min.css"> <!-- semantic.css File -->
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!-- font awesome.css file -->
			<link rel="stylesheet" href="css/animate.css"> <!-- Animate.CSS File -->
			<link rel="stylesheet" href="css/owl.carousel.css"> <!-- Owl Carousel.CSS File -->
			<link href="css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
			<link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
			<link rel="stylesheet" href="css/media.css"> <!-- Media Query File -->
			<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> <!-- Font -->
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
                                <?php
                                if (!isset($_SESSION ['username'])) {
                                    echo "<ul>
                                        <li><a href='#' id='signin-modal'>Log In</a></li>
                                        <li>|</li>
                                        <li><a href='#' id='regest-modal'>Register</a></li>
                                    </ul>";
                                } else {
                                    if ($_SESSION['userType'] == 2) {
                                        echo "<ul> <li><a href='./Admin'>Admin Panel</a></li> <li><a href='user-profile.php'>My Profile</a></li> <li><a href='logout.php'>Logout</a></li></ul>";
                                    } else {
                                        echo "<ul> <li><a href='user-profile.php'>My Profile</a></li> <li><a href='logout.php'>Logout</a></li></ul>";
                                    }
                                }
                                ?>
                            	</div>

										<div id="search-input" class="float-left">
											<input type="text" name="search" placeholder="Search..">
										</div>

										<div id="nav-card" class="float-left">
											<a href="#"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
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

                <div class="about">
                 <div class="container">

                         <h1>Congratulation</h1>
<center>
                         		<table border='5px'>
								<tr>
									<th>Product Name</th>
									<th>Image</th>
									<th>Quantity</th>
									<th>Price</th>
								</tr>

								<?php
                $amountToPay = 0;
								if(isset($_SESSION['completedPayment']) != null){
									if($_SESSION['completedPayment'] == 1){
									$_SESSION['completedPayment'] = NULL;
									$result = $user->getCart();
									while($cartItem = $result->fetch_assoc()){
									$productId = $cartItem['productId'];
									$productName = $cartItem['productName'];
									$productPrice = $cartItem['productPrice'];
									$productDiscount = $cartItem['productDiscount'];
									$productImage = $cartItem['productPicture'];
									$productQuantity = $cartItem['productQuantity'];
									$productRealPrice = ($productPrice - ($productPrice * $productDiscount / 100)) * $productQuantity;
									echo ($productRealPrice = ($productPrice - ($productPrice * $productDiscount / 100)) * $productQuantity) . "<BR>";
									$amountToPay += $productRealPrice;
									echo "
										<tr>
									<td>$productName</td>
									<td><img src='images/$productImage.jpg' style='width:100px;height:100px;'></td>
									<td>$productQuantity</td>
									<td>\$$productRealPrice</td>
										</tr>
											";
									}
									foreach ($_SESSION['myCart'] as $productId){
									$deleteQuery = "UPDATE product SET productQuantity = 0 WHERE productId='$productId';";
									$conn->query($deleteQuery);
									unset($_SESSION['myCart']);
									$userId = $_SESSION['userId'];
									$deleteCartQuery = "DELETE FROM Cart Where userId='$userId';";
									$conn->query($deleteCartQuery);
									}
									} else {
										$userMessage = "Payment Error, Please compelete the payment from your cart and try again Error Code 1";
									}
								} else {
									$userMessage = "Payment Error, Please compelete the payment from your cart and try again Error Code 2";
								}

								?>
							</table>
							</center>
                             <center>     <a href="index.php"><button  class="btn" value="Return To Home" name="Return To Home"/>Return To Home</a></center>
                         </center>

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


    <script>
<?php
echo "var userMessage = \"$userMessage\";";
$userMessage = NULL;
?>
        if (userMessage != 'undefined' && userMessage != "") {
            alert(userMessage);
        }
    </script>
			  <script src="js/jquery.min.js"></script> <!-- Jquery Mini file -->
			  <script src="js/wow.min.js"></script> <!-- WOW.js Mini file -->
			  <script src="js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
			  <script>new WOW().init();</script> <!-- Activate WOW.js File -->
			  <script src="js/semantic.min.js"></script> <!-- semantic Js File -->
			  <script src="js/script.js"></script> <!-- Externa Js File file - My File -->

        </body>
    </html>
