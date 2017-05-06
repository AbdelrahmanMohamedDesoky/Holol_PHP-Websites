<?php
require_once ('./Guest.php');
$validator = new Validation();
$guest = new Guest();
if (isset($_POST['signin'])) {
	$username = cleanSQL($_POST['username']);
	$password = $_POST['password'];
	if($validator->validateLength($username, 6, "Username") && $validator->validateLength($password, 6, "Password")){
		if($guest->signin($username, $password)){
			notify("Success",$guest->getLastSuccessMessage());
		} else {
			notify("Error",$guest->getLastErrorMessage());
		}
	} else {
		notify("Error",$validator->getLastErrorMessage());
	}
} 
else if (isset($_POST['signup'])) {
	if ($validator -> validateUsername(cleanSQL($_POST['username'])) && $validator -> validateEmail(cleanSQL($_POST['email2'])) && $validator -> validateLength($_POST['password'], 6, "Password") && $validator -> validateLength($_POST['confirm_password'], 6, "Password Confirm")) {
		if ($_POST['password'] == $_POST['confirm_password']) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$email = $_POST['email2'];
			if ($guest -> signup($username, $email, $password)) {
				notify("Success",$guest -> getLastSuccessMessage());
			} else {
				notify("Error",$guest -> getLastErrorMessage());
			}
		} else {
			notify("Error","Passwords Does not Match");
		}
	} else {
		notify("Error",$validator->getLastErrorMessage());
	}
}
?>