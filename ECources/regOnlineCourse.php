<?php
require_once("dbConnection.php");
require_once("loginCheck.php");
if (isset($_GET['courseId'])) {
    $courseId = cleanSQL($_GET['courseId']);
    $username = $_SESSION['username'];
    $userId = $_SESSION['id'];
    $duplicateQueryCheck = "SELECT * FROM useron WHERE UserId = '$userId' AND OnId = '$courseId';";
    $result = mysqli_query($db, $duplicateQueryCheck);
    if (mysqli_num_rows($result) == 0) {
        $regCourseQuery = "INSERT INTO `useron`(`UserId`, `OnId`) VALUES ($userId,$courseId)";
        if (mysqli_query($db, $regCourseQuery)) {
            $errorMessage = "<br> <center> <strong >You have registered in the course successfully </strong> </center>";
        } else {
            $errorMessage = "<br> <center> <strong> Unknown Error occured " . mysqli_error($db) . " </strong> </center>";
        }
    } else {
        $errorMessage = "<br> <center> <strong> Error : You have already registered in this course. </strong> </center>";
    }
}
?>

<HTML>
    <?php
    if (isset($errorMessage)) {
        echo $errorMessage;
        $errorMessage = NULL;
        echo "<br> <center> <strong> You Will be redirected to courses again in 5 seconds </strong> </center>";
        header("refresh:5; url=online-courses.php");
    }
    ?>
    <a href="index.php">Home !</a>
</HTML>