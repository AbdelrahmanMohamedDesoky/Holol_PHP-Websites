<?php
require("dbConnection.php");
require("adminCheck.php");
if (isset($_POST['add'])) {
    $errorMessage = "";

    function checkForErrors($name, $price, $hours, $description, $img,$link) {
        global $errorMessage;
        $noErrors = true;
        if (!isset($name) || !isset($price) || !isset($hours) || !isset($description) || !isset($link)) {
            $noErrors = false;
            $errorMessage = "<br> <strong> error with details please check input again </strong> ";
            return $noErrors;
        }
        if (strlen($link) < 2){
            $noErrors = false;
            $errorMessage = "<br> <strong> Error with course Link please fix it </strong> ";
        }
        if (filter_var($link, FILTER_VALIDATE_URL) === false){
            $noErrors = false;
            $errorMessage = "<br> <strong> Error with course Link please fix it </strong> ";
        }
        if (strlen($name) < 2 || strlen($description) < 2) {
            $noErrors = false;
            $errorMessage = "<br> <strong> error details are too small must be greater than 2 length </strong>";
        }
        if(filter_var($price, FILTER_VALIDATE_INT) === false){
           $noErrors = false;
           $errorMessage = "<br> <strong> Price isn't an integer</strong>";
        } else {
           if($price <= 0){
           $noErrors = false;
           $errorMessage = "<br> <strong> Price can't be less than $1</strong>";
            }
        }
        if(filter_var($hours, FILTER_VALIDATE_INT) === false){
           $noErrors = false;
           $errorMessage = "<br> <strong> Hours isn't an integer</strong>";
        } else {
           if($hours <= 0){
           $noErrors = false;
           $errorMessage = "<br> <strong> Hours can't be less than 1 hour</strong>";
            }
        }
        if (!isset($img)) {
            $noErrors = false;
            $errorMessage = "<br> <strong> Please Select An Image</strong>";
        } else {
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $uploadedFile = $_FILES['img']['tmp_name'];
            $fileType = finfo_file($fileInfo, $uploadedFile);
            if (!(strpos($fileType, 'image') !== false)) {
                $noErrors = false;
                $errorMessage = "<br><strong> Image wasn't an actual image error.</strong>";
            }
        }
        return $noErrors;
    }

    if (checkForErrors($_POST['name'], $_POST['price'], $_POST['hours'], $_POST['description'], $_FILES['img'],$_POST['link'])) {
        $name = cleanSQL($_POST['name']);
        $price = cleanSQL($_POST['price']);
        $hours = cleanSQL($_POST['hours']);
        $description = cleanSQL($_POST['description']);
        $courseLink = $_POST['link'];
        $catId = cleanSQL($_POST['catId']);
        $imgName = uniqid();
        move_uploaded_file($_FILES['img']['tmp_name'], "../coursesImg/$imgName.jpg");
        $offlineCourseQuery = "INSERT INTO `onlinecou` (`OnId`, `courseName`, `coursePrice`, `courseNumOfHours`, `OnDis`,`OnImage`, `OnLink`, `AdminId`, `CatId`) VALUES (NULL, '$name', '$price', '$hours', '$description', '$imgName', '$courseLink', '1', '$catId');";
        $result = mysqli_query($db, $offlineCourseQuery);
        if ($result) {
            $errorMessage = "<br> <strong> Course has been added successfully </strong>";
        } else {
            $errorMessage = "<br> <Strong> Error has occured " . mysqli_error($db) . " nothing was affected";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title></title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/course.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="course">
            <div class="container">
                <form method="post" action="addOnlineCourse.php" enctype="multipart/form-data">
                    <h2>Add Online Courses</h2>
                    <label>Name :</label><br>
                    <input type="text" name="name" required><br><br>
                    <label>Price :</label><br>
                    <input type="number" name="price" required><br><br>
                    <label>No. Of Hours :</label><br>
                    <input type="number" name="hours" required><br><br>
                    <label>Short Describtion :</label><br>
                    <textarea name="description" required></textarea><br><br>
                    <label>Course Link :</label><br>
                    <textarea name="link" required></textarea><br><br>
                    <label>Category : </label>
                    <select name = "catId" required>
                        <?php
                        $catagoryQuery = "SELECT * FROM category;";
                        $result = mysqli_query($db, $catagoryQuery);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $catId = $row['CatId'];
                                $catName = $row['CatName'];
                                echo "<option value=\"$catId\">$catName</option>";
                            }
                        }
                        ?>
                    </select> <br><br>
                    <label> Course Picture : </label> <input type='file' name='img' required>
                    <button type="submit" class="btn btn-default" name="add">
                        Add </button>
                </form>
                <?php
                if (isset($errorMessage)) {
                    echo $errorMessage;
                    $errorMessage = NULL;
                }
                ?>
            </div>
        </div>
    <center> </br> </br> <a href="index.php">Admin Home Page</a> </br> </br> </center>
    <center>  <a href="logout.php">Logout</a> </center>
    <script src="js/jquery-1.12.1.min.js"></script> 
    <!-- Jquery Mini file -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
</body>