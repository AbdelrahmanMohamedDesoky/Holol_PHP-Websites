<?php
require ("Admin.php");
require ("Validation.php");
$validator = new Validation();
$user = new User ();
require 'login.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

        <title>E-Commerce | Home</title>

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
<style>  
#modalContainer {
    background-color:rgba(0, 0, 0, 0.3);
    position:absolute;
    width:100%;
    height:100%;
    top:0px;
    left:0px;
    z-index:10000;
    background-image:url(tp.png); /* required by MSIE to prevent actions on lower z-index elements */
}

#alertBox {
    position:relative;
    width:300px;
    min-height:100px;
    margin-top:50px;
    border:1px solid #666;
    background-color:#fff;
    background-repeat:no-repeat;
    background-position:20px 30px;
}

#modalContainer > #alertBox {
    position:fixed;
}

#alertBox h1 {
    margin:0;
    font:bold 0.9em verdana,arial;
    background-color:#3073BB;
    color:#FFF;
    border-bottom:1px solid #000;
    padding:2px 0 2px 5px;
}

#alertBox p {
    font:0.7em verdana,arial;
    height:50px;
    padding-left:5px;
    margin-left:55px;
}

#alertBox #closeBtn {
    display:block;
    position:relative;
    margin:5px auto;
    padding:7px;
    border:0 none;
    width:70px;
    font:0.7em verdana,arial;
    text-transform:uppercase;
    text-align:center;
    color:#FFF;
    background-color:#357EBD;
    border-radius: 3px;
    text-decoration:none;
}

/* unrelated styles */

#mContainer {
    position:relative;
    width:600px;
    margin:auto;
    padding:5px;
    border-top:2px solid #000;
    border-bottom:2px solid #000;
    font:0.7em verdana,arial;
}

h1,h2 {
    margin:0;
    padding:4px;
    font:bold 1.5em verdana;
    border-bottom:1px solid #000;
}

code {
    font-size:1.2em;
    color:#069;
}

#credits {
    position:relative;
    margin:25px auto 0px auto;
    width:350px; 
    font:0.7em verdana;
    border-top:1px solid #000;
    border-bottom:1px solid #000;
    height:90px;
    padding-top:4px;
}

#credits img {
    float:left;
    margin:5px 10px 5px 0px;
    border:1px solid #000000;
    width:80px;
    height:79px;
}

.important {
    background-color:#F5FCC8;
    padding:2px;
}

code span {
    color:green;
}

</style>

<script>
var ALERT_TITLE = "Notification!";
var ALERT_BUTTON_TEXT = "Ok";

if(document.getElementById) {
    window.alert = function(txt) {
        createCustomAlert(txt);
    }
}

function createCustomAlert(txt) {
    d = document;

    if(d.getElementById("modalContainer")) return;

    mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
    mObj.id = "modalContainer";
    mObj.style.height = d.documentElement.scrollHeight + "px";

    alertObj = mObj.appendChild(d.createElement("div"));
    alertObj.id = "alertBox";
    if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
    alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
    alertObj.style.visiblity="visible";

    h1 = alertObj.appendChild(d.createElement("h1"));
    h1.appendChild(d.createTextNode(ALERT_TITLE));

    msg = alertObj.appendChild(d.createElement("p"));
    //msg.appendChild(d.createTextNode(txt));
    msg.innerHTML = txt;

    btn = alertObj.appendChild(d.createElement("a"));
    btn.id = "closeBtn";
    btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
    btn.href = "#";
    btn.focus();
    btn.onclick = function() { removeCustomAlert();return false; }

    alertObj.style.display = "block";

}

function removeCustomAlert() {
    document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalContainer"));
}
</script>



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
                                <?php
                                if (isset($_SESSION['username'])) {
                                    $username = $_SESSION['username'];
                                    echo "<li>Welcome $username</li>";
                                } else {
                                    echo "<li>Welcome Guest</li>";
                                }
                                ?>
                            </ul>
                        </div>

                        <div class="float-right" id="top-nav-right">
                            <ul>
                                <li><a href="./index.php">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="ContactUs.php">Contact Us</a></li>
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
                <div id="bottom-nav"  style='background-color:<?php echo $user->getColor(); ?>;'>
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
										<form action = './searchResult.php' METHOD='POST'>
										<input type="text" name="productName" placeholder="Search..">
										<input class="btn primary" type="submit" name = "Search">
										</form>
											
										</div>

                            <div id="nav-card" class="float-left">
                                <a href="./user-profile.php#tabs-4"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></a>
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
                             Main Slider SECTION
            ************************************-->
            <header id="header">
                <div class="container-fluid">
                    <div id="header-left" class="float-left">
                        <div class="lg-add float-left">
                            <?php 
                            if($admin->getAds(1) !== false){
                            	$result = $admin->getAds(1);
                            	$adsRow = $result->fetch_assoc();
                            	$adsPicture = $adsRow['adsPicture'];
                            	$adsUrl = $adsRow['adsUrl'];
                            	echo "<a href='$adsUrl'><img src='./images/$adsPicture.jpg' alt='$adsUrl'></a>";
                            } else {
                            	echo "<a href='./buyAds.php?id=1'><img src='http://placehold.it/382x405?text=ADVERTISEMENT' alt='addvertisment'></a>";
                            }
                            ?>
                        </div>
                    </div>
                    <div id="header-right" class="float-left">

                        <!--***********************************
                                        OWL CAROUSEL SECTION
                        ************************************-->
                        <div class="header-carousel">

                            <div class="item" id="slide-3">
                                <div class="offer-lable">Offer</div>
                                <h1>WATCHES&JEWELRY</h1>
                                <p>Mineral Glass Water Resistant Leather
                                    Band Regular timekeeping Analog: 3
                                    hands (hour, minute, second) Accuracy:
                                    ±20 seconds per month Approx. battery
                                    life: 3 years on SR626SW Size of case:
                                    45 × 38 × 8 mm
                                </p>
                                <button class='btn'>Shop Now</button>
                            </div>
                            <div class="item" id="slide-4">
                                <div class="offer-lable">Offer</div>
                                <h1>New Apple tablte is here</h1>
                                <p>Apple are release a new tablet, It is intelegent, smart, more fastest and new design.</p>
                                <button class='btn'>Shop Now</button>
                            </div>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
            </header>

            <!--***********************************
                            ADDVERTOSMENT SECTION
            ************************************-->
            <section id="addvertis">
                <div class="container">
				 <?php 
                            if($admin->getAds(2) !== false){
                            	$result = $admin->getAds(2);
                            	$adsRow = $result->fetch_assoc();
                            	$adsPicture = $adsRow['adsPicture'];
                            	$adsUrl = $adsRow['adsUrl'];
                            	echo "<a href='$adsUrl'><img src='./images/$adsPicture.jpg' alt='$adsUrl'></a>";
                            } else {
                            	echo "<a href='./buyAds.php?id=2'><img src='http://placehold.it/750x150?text=ADVERTISEMENT' alt='' class='lg-add' alt='addvertisment'></a>";
                            }
                 ?>
                </div>
            </section>



            <!--***********************************
                                    OFFERS SECTION
            ************************************-->
            <section id="offers">
                <div class="container-fluid">
                    <div class="offers-carousel">
                        <!--***********************************
                                                CAROUSEL ITEMS
                        ************************************-->
                        <?php 
                        $result = $admin->getOfferedProducts();
                        while($productRow = $result->fetch_assoc()){
                        	$productId = $productRow['productId'];
                        	$productPicture = $productRow['productPicture'];
                        	$productPrice = $productRow['productPrice'];
                        	$productDiscount = $productRow['productDiscount'];
							$productName = $productRow['productName'];
                        	$productRealPrice = $productPrice - ($productPrice*$productDiscount/100);
                        	echo "<div class='item'>
                            <img src='./images/$productPicture.jpg' alt='' />
                            <div class='offer-item'>
                            	<h3>ProductName : $productName </h3>
                                <h2>Offer: $$productRealPrice</h2>
                                <p><del>Price: $$productPrice</del></p>
                                <input type='button' class='btn' onclick=\"location.href='viewProductInfo.php?id=$productId';\" value='View Product Info'/>
                            </div>
                        </div>";
                        }
                        ?>
                    </div>
                </div>
            </section>


            <!--***********************************
                            ADDVERTOSMENT SECTION
            ************************************-->
            <section id="addvertis">
                <div class="container">
                 <?php 
                            if($admin->getAds(3) !== false){
                            	$result = $admin->getAds(3);
                            	$adsRow = $result->fetch_assoc();
                            	$adsPicture = $adsRow['adsPicture'];
                            	$adsUrl = $adsRow['adsUrl'];
                            	echo "<a href='$adsUrl'><img src='./images/$adsPicture.jpg' alt='$adsUrl'></a>";
                            } else {
                            	echo "<a href='./buyAds.php?id=3'><img src='http://placehold.it/750x150?text=ADVERTISEMENT' alt='' class='lg-add' alt='addvertisment'></a>";
                            }
                 ?>
                </div>
            </section>


            <!--***********************************
                                    MOST RECENT SECTION
            ************************************-->
            <section id="most-recent">
                <div class="container-fluid">

                    <div class="most-recent-carousel">
                        <!--***********************************
                                                CAROUSEL ITEMS
                        ************************************-->
						<?php 
						$result = $admin->getAllProductsWithoutDiscount();
						while($productRow = $result->fetch_assoc()){
							$productId = $productRow['productId'];
							$productPicture = $productRow['productPicture'];
							$productPrice = $productRow['productPrice'];
							$productDiscount = $productRow['productDiscount'];
							$productName = $productRow['productName'];
							$productRealPrice = $productPrice - ($productPrice*$productDiscount/100);
							echo "<div class='item'>
                            <img src='./images/$productPicture.jpg' alt='' />
                            <div class='most-recent-item'>
                                <h2>Most recent</h2>
                                <h3>ProductName : $productName </h3>
							<p>Price: $$productPrice</p>
							<input type='button' class='btn' onclick=\"location.href='viewProductInfo.php?id=$productId';\" value='View Product Info'/>
							</div>
							</div>";
						}
						?>
                    </div>
                </div>
            </section>


            <!--***********************************
                            ADVERTOSMENT SECTION
            ************************************-->
		 <section id="addvertis">
                <div class="container">
				 <?php 
                            if($admin->getAds(4) !== false){
                            	$result = $admin->getAds(4);
                            	$adsRow = $result->fetch_assoc();
                            	$adsPicture = $adsRow['adsPicture'];
                            	$adsUrl = $adsRow['adsUrl'];
                            	echo "<a href='$adsUrl'><img src='./images/$adsPicture.jpg' alt='$adsUrl'></a>";
                            } else {
                            	echo "<a href='./buyAds.php?id=4'><img src='http://placehold.it/750x150?text=ADVERTISEMENT' alt='' class='lg-add' alt='addvertisment'></a>";
                            }
							
                 ?>
				</div>
				</section>


            <!--***********************************
                                    FOOTER SECTION
            ************************************-->
            <footer id="footer">

                <!--*********************
                          MAIN FOOTER
                **********************-->
                <div id="main-footer" style='background-color:<?php echo $user->getColor();?>;'>
                    <div class="container-fluid">

                        <!--*********************
                           popular search sec.
                        **********************-->
                        <div id="footer-popular-search">
                            <h4>popular searches</h4>
                            <div class="content">
                                <ul>
                                    <li><a href="http://www.gsmarena.com/apple_iphone_6s-7242.php">iphone 65</a></li>
                                    <li><a href="http://genius.com/Yo-gotti-white-friday-lyrics">white friday</a></li>
                                    <li><a href="http://infinixmobility.com/smartphone/hot-note/">infinix hot note</a></li>
                                    <li><a href="http://www.wintouch.ae/product/q93s-cn.html">wintouch Q935 tablet</a></li>
                                    <li><a href="http://www.g-tidemobile.com/">G Tide</a></li>
                                </ul>
                            </div>
                            <h4>LEARNING CENTER</h4>
                            <div class="content">
                                <ul>
                                    <li><a href="https://sa.ucla.edu/ro/public/soc">Classes</a></li>
                                    <li><a href="http://egypt.souq.com/eg-en/learning-library/c/">Library</a></li>
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
                                    <li><a href="index.php">LogIn\ Register</a></li>
                                    <li><a href="user-profile.php">Cart</a></li>
                                    
                                    
                                </ul>
                            </div>
                            <h4>INTELLECTUAL PROPERTY</h4>
                            <div class="content">
                                <ul>
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
                                    
                                </ul>
                            </div>
                            <h4>BUYING ON</h4>
                            <div class="content">
                                <ul>
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
                                            <li><a href="https://www.facebook.com/" class="fb-icon"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                                            <li><a href="https://twitter.com" class="twitter-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li><a href="https://www.google.com.eg/" class="google-icon"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
                                            <li><a href="https://www.youtube.com/" class="yu-icon"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
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
