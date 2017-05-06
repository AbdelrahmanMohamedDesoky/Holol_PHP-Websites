<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['username'])) {
    echo "<br> <center> <strong> Please Login First ! <br> You will be redirected in 5 seconds to the login page </strong> </center> ";
    header("refresh:5; url=index.php");
    die();
}
?>