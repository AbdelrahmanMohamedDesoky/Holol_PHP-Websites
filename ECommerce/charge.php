<?php
  require_once("encryption.php");
  require_once('config.php');
  require_once('loginCheck.php');
  $admin = new Admin();
  $encryption = new Encryption();
  $userId = $_SESSION['userId'];
  $amount = $_SESSION['amountToPay'];
  $token  = $_POST['stripeToken'];
  $email  = encryption::encrypt($_POST['stripeEmail']);
  $customerName = encryption::encrypt($_POST['stripeBillingName']);
  $address = encryption::encrypt($_POST['stripeBillingAddressLine1']);
  $postalCode = encryption::encrypt($_POST['stripeBillingAddressZip']);
  $city = encryption::encrypt($_POST['stripeBillingAddressCity']);
  $country = encryption::encrypt($_POST['stripeBillingAddressCountry']);
 	try {
		$customer = \Stripe\Customer::create(array(
  			'email' => $email,
  			'source'  => $token
  	));
		$charge = \Stripe\Charge::create(array(
  			'customer' => $customer->id,
  			'amount'   => $amount,
  			'currency' => 'usd'
  	));
	echo "<center> <h3>Payment was Successfull ! Redirecting ...</h3> </center>";
	$_SESSION['completedPayment'] = 1;
	$products = $_SESSION['myCart'];
	$amount = $amount/100;
	foreach ($products as $productId){
		$sellerId = $admin->getSellerId($productId);
		$customerQuery = "INSERT INTO soldproduct(`buyerId`,`sellerId`,`productId`,`paymentType`,`paymentDate`,`paymentState`,`customerName`,`customerEmail`,`customerAddress`,`customerPostalCode`,`customerCity`,`customerCountry`)
		VALUES('$userId','$sellerId','$productId','Stripe',NOW(),'Paid - $$amount','$customerName','$email','$address','$postalCode','$city','$country');";
		$result = $conn->query($customerQuery);
	}
	
	} catch (Exception $ex){
		echo "<br> <h1> " . $ex->getMessage() . "</h1>";
	}
	header("refresh:3; url=Congratulation.php"); 
?>