<?php

require("dbConnection.php");
require("loginCheck.php");
if (isset($_GET['courseId'])) { // online course id
    $courseId = cleanSQL($_GET['courseId']);
    $userId = $_SESSION['id'];
    $noErrors = true;
    if (strlen($courseId) < 1) {
        $errorMessage = "<br><strong> Error with course id please go back and try again later </strong>";
        $noErrors = false;
    }
    if (filter_var($courseId, FILTER_VALIDATE_INT) === false) {
        $errorMessage = "<br><strong> Error with course id please go back and try again later </strong>";
        $noErrors = false;
    }
    if ($noErrors) {
        $checkEnrolQuery = "SELECT * FROM useron WHERE UserId='$userId' AND OnId='$courseId';";
        $checkResult = mysqli_query($db, $checkEnrolQuery);
        if (mysqli_num_rows($checkResult) >= 1) {
            $courseQuery = "SELECT OnLink FROM onlinecou WHERE OnId='$courseId';";
            $linkResult = mysqli_query($db, $courseQuery);
            $onLink = mysqli_fetch_array($linkResult);
            $onLinkTrue = $onLink['OnLink'];
            echo "<strong> You will be redirected to the course video soon, Don't forget us. </strong>";
            header("refresh:5; url=$onLinkTrue");
        }
    } else {
        echo $errorMessage;
        header("refresh:5; url=online-courses.php");
    }
}
?>