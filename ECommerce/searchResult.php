<?php
require ("Admin.php");
require ("Validation.php");
$validator = new Validation();
$user = new User ();
$admin = new Admin();
require 'login.php';
if(!isset($_SESSION)){
	session_start();
}
$productName = cleanSQL($_POST['productName']);

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

					 <title>Result</title>
			<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
			<link rel="stylesheet" href="css/semantic.min.css"> <!-- semantic.css File -->
			<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"> <!-- font awesome.css file -->
			<link rel="stylesheet" href="css/animate.css"> <!-- Animate.CSS File -->
			<link rel="stylesheet" href="css/owl.carousel.css"> <!-- Owl Carousel.CSS File -->
			<link href="css/hover.css" rel="stylesheet" media="all"> <!-- Hover.CSS File -->
			<link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
			<link rel="stylesheet" href="css/media.css"> <!-- Media Query File -->

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


				<!--***********************************
							NAVBAR SECTION
				************************************-->
			<?php
			  include 'header.php';
			?>
				<!--***********************************
							about SECTION
				************************************-->
				
                <div class="container_fluid">
				
				<!-- product itemt -->
				<?php 
				$result = $admin->showProduct($productName);
				if($result->num_rows > 0){
					while($productRow = $result->fetch_assoc()){
						$productId = $productRow['productId'];
						$productName = $productRow['productName'];
						$productPrice = $productRow['productPrice'];
						$productDiscount = $productRow['productDiscount'];
						$productQuantity = $productRow['productQuantity'];
						$productPicture = $productRow['productPicture'];
						$productRealPrice = ($productPrice - (($productPrice * $productDiscount) / 100));
						echo "<center>
                <div class='container' style='margin:10px;border :2px solid orange;'>
                       <div class='col-lg-3' style='height:180px;'>
                       <img src='./images/$productPicture.jpg' style='width:100%;height:180px;'>
                         </div>                      
						 <div class='col-lg-6'  style='height:180px;'>
                    <table class='table table-striped' style='width:100%;'>
						<tr>
						<td>productName : <a href='viewProductInfo.php?id=$productId'> $productName </a></td> <td> </td>
						</tr>
						<tr> <td>productPrice : $ $productRealPrice</td> <td> </td></tr>
						<tr> <td>productQuantity : $productQuantity</td> <td> </td> </tr>
						<tr> <td>productDiscount : %$productDiscount</td> <td> </td> </tr>        
					</table> 
						 </div> 
				</div>
							</center>";
					}
				} else {
					echo "<br><center><h3>No Products Were found with that Name</h3></center>";
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
