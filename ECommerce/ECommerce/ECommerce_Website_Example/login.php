<?php

if (isset($_POST ['signup'])) { // sign up was pressed
    $username = cleanSQL($_POST ['username']);
    $password = $_POST ['password'];
    $password_confirm = $_POST ['password_confirm'];
    $email = cleanSQL($_POST ['email']);
    $nationalId = cleanSQLNationalId($_POST ['nationalId']);
    $userType = cleanSQLNationalId($_POST ['userType']);
    if ($validator->validateUsername($username) &&
    	$validator->validateLength($password, 6) &&
    	$validator->validateEmail($email) &&
    	$validator->validateNationalId($nationalId) &&
    	$validator->validateUserType($userType) &&
    	$password == $password_confirm) {
    	$user->signup($username, $password, $email, $nationalId, $userType);
        $userMessage = "Successfully Registered";
    } else {
        $userMessage = "Error : " . $validator->getLastError();
    }
} else if (isset($_POST ['signin'])) {
    $username = cleanSQL($_POST ['username']);
    $password = $_POST ['password'];
    if ($user->signin($username, $password)) {
        $userMessage = "Successfully Logged In";
    } else {
        $userMessage = "Error : " . $user->getLastErrorMessage();
    }
}
if (!isset($_SESSION)) {
    session_start();
}
?>