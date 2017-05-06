<?php
require("dbConnection.php");
$errorMessage = "";

function checkForErrors($email, $username, $password, $password_confirm) { // function checkForErrors takes 4 param : $email,$username,$password,$passwordConfirmation and return true if no errors
    global $oldUsername;
    global $db;
    global $errorMessage;
    $noError = true;
    if (!isset($email) || !isset($username) || !isset($password) || !isset($password_confirm)) {
        $noError = false;
        $errorMessage = "<strong> Email/Username/Password/PasswordConfirm can't be empty </strong>";
        return $noError;
    }
    // check email address if not valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $noError = false;
        $errorMessage = "<strong> Email Address not valid </strong>";
    }
    //check for username/password lengh
    if (strlen($username) < 6 || strlen($password) < 6 || strlen($email) < 6) {
        $errorMessage = "<strong> Username/Password/Email is too small 6 length minimum </strong>";
        $noError = false;
    }
    // check if username exists when registering as a new user
    if (!isset($oldUsername)) {
        $usernameQuery = "SELECT * FROM user WHERE username='$username';";
        $result = mysqli_query($db, $usernameQuery);
        if (mysqli_num_rows($result) != 0) {
            $errorMessage = "<strong> username already taken </strong>";
            $noError = false;
        }
    } else if (isset($oldUsername)) { // check if username exists when editing username
        $oldUsername = cleanSQL($oldUsername);
        $usernameQuery = "SELECT * FROM user WHERE username='$username' AND username != '$oldUsername';";
        $result = mysqli_query($db, $usernameQuery);
        if (mysqli_num_rows($result) != 0) {
            $errorMessage = "<strong> username already taken </strong>";
            $noError = false;
        }
    }
    // check if passwords aren't the same
    if ($password != $password_confirm) {
        $errorMessage = "<strong> Passwords doesn't match </strong>";
        $noError = false;
    }
    return $noError;
}

if (isset($_POST['sign-in'])) {
    // sign in was pressed
    $username = cleanSQL($_POST['username']);
    $password = md5($_POST['password']);
    $loginQuery = "SELECT * FROM user WHERE username='$username' AND Password='$password';";
    $result = mysqli_query($db, $loginQuery);
    if (mysqli_num_rows($result) == 1) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['username'] = $username;
        // admin check 
        $row = mysqli_fetch_array($result);
        if ($row['userType'] == 1) {
            $_SESSION['isAdmin'] = true;
        }
        $_SESSION['id'] = $row['uid'];
        $webpage = $_SERVER["PHP_SELF"];
        header("Location: $webpage");
    } else {
        $errorMessage = "<center> <strong> Invalid Username/Password </strong> </center>";
    }
} else if (isset($_POST['sign-up'])) {
    // sign up was pressed
    if (checkForErrors($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password_confirm'])) {
        $username = cleanSQL($_POST['username']);
        $password = md5($_POST['password']);
        $password_confirm = md5($_POST['password_confirm']);  //function hach
        $firstName = cleanSQL($_POST['firstname']);
        $lastName = cleanSQL($_POST['lastname']);
        $email = cleanSQL($_POST['email']);
        $registerQuery = "INSERT INTO `user` (`uid`, `Fname`, `Sname`, `username`, `Password`, `mail`,`userType` ) VALUES (NULL, '$firstName', '$lastName', '$username', '$password', '$email',0);";
        $result = mysqli_query($db, $registerQuery);
        if ($result) {
            $errorMessage = "<strong> User has successfully registerd </strong>";
            if (isset($_FILES['img'])) {
                $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
                $uploadedFile = $_FILES['img']['tmp_name'];
                $fileType = finfo_file($fileInfo, $uploadedFile);
                if (strpos($fileType, 'image') !== false) {
                    move_uploaded_file($_FILES['img']['tmp_name'], "uploads_users/$username.jpg");
                } else {
                    $errorMessage = "<strong> Successfully Registered but the image wasn't uploaded because it wasn't an image edit it from profile.</strong>";
                }
            }
        }
    }
}
?>