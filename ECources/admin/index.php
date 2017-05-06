<?php
require("adminCheck.php"); // verify admin login and do the checks there
?>
<HTML>
    Welcome Admin : <?php echo $_SESSION['username'] ?> </br> </br>
    <a href="addArticle.php">Add Article</a> </br> </br>
    <a href="editArticle.php">Edit/Delete Article</a> </br> </br>
    <a href="addCategory.php">Add Catagory</a> </br> </br>
    <a href="editCategory.php">Edit/Delete Catagory</a> </br> </br>
    <a href="addOfflineCourse.php">Add Offline Course</a> </br> </br>
    <a href="editOfflineCourse.php"> Edit/Delete Offline Course</a> </br> </br>
    <a href="addOnlineCourse.php">Add Online Course</a> </br> </br>
    <a href="editOnlineCourse.php"> Edit/Delete Online Course</a> </br> </br>
    <a href="logout.php">Logout !</a> </br> </br>
</HTML>