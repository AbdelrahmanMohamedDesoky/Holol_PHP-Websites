<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
}
if (!isset($_SESSION['isAdmin'])) {
    echo "Error , you aren't an admin, you aren't supposed to be here go back";
    echo '<br><br><a href="../index.php">Go Back</a>';
    die();
}
?>