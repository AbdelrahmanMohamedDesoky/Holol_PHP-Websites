<?php
if (isset($_POST['submit'])) {
    if(strlen($_POST['name']) < 2){
        $errorMessage = "<strong> Name is too short min 2 letter.</strong>";
        return;
    }
    if(strlen($_POST['subject']) < 2){
        $errorMessage = "<strong> Subject is too short min 2 letters. </strong>";
        return;
    }
    if(strlen($_POST['message']) < 2){
        $errorMessage = "<strong> Message is too short min 2 letters. </strong>";
        return;
    }
    // check email address if not valid
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errorMessage = "<strong> Email Address not valid </strong>";
        exit("$errorMessage");
    }
    $subject = cleanSQL($_POST["subject"]);
    $message = "Name:" . $_POST["name"] . "<br>from :" . $_POST["email"] . "<br>message :" . $_POST["message"] . "</br>";
    $message = wordwrap($message, 70);
    $sendTo = "omartammam85@gmail.com";
    if (mail($sendTo, $subject, $message)) {
        $emailSentMessage = "<strong> Email was sent ! </strong>";
    } else {
        $emailSentMessage = "<strong> an error occured while sending the email </strong>";
    }
}
?>