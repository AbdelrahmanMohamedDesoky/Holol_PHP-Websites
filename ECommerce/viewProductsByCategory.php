<?php
require_once("Admin.php");
$admin = new Admin();
$user = new User ();
require 'login.php';
if (! isset ( $_SESSION )) {
	session_start ();
}
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

					 <title>Result</title>

      <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> <!-- Font -->
       
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
<?php  include'header.php'  ?>
				<!--***********************************
							about SECTION
				************************************-->
				  <div style="width:100%;height:auto;margin-bottom:300px;margin-top:50px;">
				 <?php 
				 if(isset($_GET['subId'])){
				 	$subId = cleanSQLNationalId($_GET['subId']);
				 	$subName = $admin->getSubName($subId);
				 	echo "<h1  style='text-align:center;background-color:#4347d2;color:#fff;padding:10px;width:100%;z-index:9999;'>$subName</h1>";
				 	echo "<div class='product' style='position:relative;top:30px;'>";
				 	$result = $admin->getProductsBySubCategoryId($subId);
				 	while($productRow = $result->fetch_assoc()){
				 		$productId = $productRow['productId'];
				 		$productPicture = $productRow['productPicture'];
				 		$productPrice = $productRow['productPrice'];
				 		$productDiscount = $productRow['productDiscount'];
				 		$productRealPrice = $productPrice - ($productPrice*$productDiscount/100);
						$productName = $productRow['productName'];	
				 		echo "  <!-- product item -->
							  	<div  style='border:1px solid #000 ;margin :10px;float:left;'>
								<img src='./images/$productPicture.jpg' alt='' style='width:309px;height:350px'/>
								<div class='offer-item'>
									<h3>Product Name : $productName </h3>
									<h2>Price: $$productRealPrice</h2>
									<center><button class='btn' onclick=\"location.href='viewProductInfo.php?id=$productId';\">View Product Info</button></center>
								</div>
								</div> ";
				 	}
				 }
				 else if(isset($_GET['subSubId'])){
				 	$subSubId = cleanSQLNationalId($_GET['subSubId']);
				 	$subSubName = $admin->getSubSubName($subSubId);
				 	echo "<h1  style='text-align:center;background-color:#4347d2;color:#fff;padding:10px;width:100%;z-index:9999;'>$subSubName</h1>";
				 	echo "<div class='product' style='position:relative;top:30px;'>";
				 	$result = $admin->getProductsBySubSubCategoryId($subSubId);
				 	while($productRow = $result->fetch_assoc()){
				 		$productId = $productRow['productId'];
				 		$productPicture = $productRow['productPicture'];
				 		$productPrice = $productRow['productPrice'];
				 		$productDiscount = $productRow['productDiscount'];
				 		$productRealPrice = $productPrice - ($productPrice*$productDiscount/100);
				 		echo "  <!-- product item -->
				 		<div  style='border:1px solid #000 ;margin :10px;float:left;'>
				 		<img src='./images/$productPicture.jpg' alt='' style='width:309px;height:350px'/>
				 		<div class='offer-item'>
				 		<h2>Price: $$productRealPrice</h2>
				 		<button class='btn' onclick=\"location.href='viewProductInfo.php?id=$productId';\">View Product Info</button>
				 		</div>
				 		</div> ";
				 	}
				 } else {
				 	echo "<h1  style='text-align:center;background-color:#4347d2;color:#fff;padding:10px;width:100%;z-index:9999;'>Not Found</h1>";
				 	
				 }
				 ?>
						</div>		
					</div>
                
				<!--***********************************
							FOOTER SECTION
				************************************-->
				




</div>

			  
        <script src="js/jquery.min.js"></script> <!-- Jquery Mini file -->
        <script src="js/wow.min.js"></script> <!-- WOW.js Mini file -->
        <script src="js/owl.carousel.min.js"></script> <!-- Owl-Carousel.js Mini file -->
        <script>new WOW().init();</script> <!-- Activate WOW.js File -->
        <script src="js/semantic.min.js"></script> <!-- semantic Js File -->
        <script src="js/script.js"></script> <!-- Externa Js File file - My File -->

        </body>
    </html>
