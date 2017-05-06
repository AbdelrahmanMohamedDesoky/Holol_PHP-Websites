<?php
require("dbConnection.php");
require("adminCheck.php");

function checkForErrors($name, $price, $hours, $description, $img) {
    global $errorMessage;
    $noErrors = true;
    if (!isset($name) || !isset($price) || !isset($hours) || !isset($description)) {
        $noErrors = false;
        $errorMessage = "<br> <strong> error with details please check input again </strong> ";
        return $noErrors;
    }
    if (strlen($name) < 2 || strlen($description) < 2) {
        $noErrors = false;
        $errorMessage = "<br> <strong> error details are too small must be greater than 2 length </strong>";
    }
    if (filter_var($price, FILTER_VALIDATE_INT) === false) {
        $noErrors = false;
        $errorMessage = "<br> <strong> Price isn't an integer</strong>";
    } else {
        if ($price <= 0) {
            $noErrors = false;
            $errorMessage = "<br> <strong> Price can't be less than $1</strong>";
        }
    }
    if (filter_var($hours, FILTER_VALIDATE_INT) === false) {
        $noErrors = false;
        $errorMessage = "<br> <strong> Hours isn't an integer</strong>";
    } else {
        if ($hours <= 0) {
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
                <form method="post" action="editOfflineCourse.php" enctype="multipart/form-data">
                    <h2>Edit/Delete Courses</h2>
                    <label>Please Select a Course :</label> <br>
                    <select name = "offId">
                        <?php
                        $catagoryQuery = "SELECT * FROM offcou;";
                        $result = mysqli_query($db, $catagoryQuery);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $OffId = $row['OffId'];
                                $OffName = $row['courseName'];
                                echo "<option value=\"$OffId\">$OffName</option>";
                            }
                        }
                        ?>
                    </select>
                    <button type="submit" class="btn btn-default" name="showData"> Show Course Data </button> <br><br>
                    <?php
                    if (isset($_POST['showData'])) {
                        if (isset($_POST['offId'])) {
                            $offId = cleanSQL($_POST['offId']);
                            $courseQuery = "SELECT * FROM offcou WHERE OffId='$OffId';";
                            $result = mysqli_query($db, $courseQuery);
                            if ($result) {
                                $row = mysqli_fetch_array($result);
                                $name = $row['courseName'];
                                $price = $row['coursePrice'];
                                $hours = $row['courseNumOfHours'];
                                $description = $row['OffDis'];
                                echo "<label>Name :</label><br>
							 <input type='text' name='name' value='$name'><br><br>
							 <label>Price :</label><br>
							 <input type='number' name='price' value='$price'><br><br>
							 <label>No. Of Hours :</label><br>
							 <input type='number' name='hours' value='$hours'><br><br>
							 <label>Short Describtion :</label><br>
							 <textarea name='description'>$description</textarea><br><br>
							 <label> Course Picture : </label> <input type='file' name='img' > <br><br>";
                                echo "<button type='submit' class='btn btn-default' name='editData'> Edit Course Data </button>
							  <button type='submit' class='btn btn-default' name='deleteData'> Delete Course </button>";
                            } else {
                                $errorMessage = "<strong> An error has occured and Error is : " . mysqli_error($db) . "</strong> <br>";
                            }
                        } else {
                            $errorMessage = "<br><strong> Error Please Add/Select a course first</strong>";
                        }
                    } else if (isset($_POST['editData'])) {
                        $errorMessage = "";
                        if (checkForErrors($_POST['name'], $_POST['price'], $_POST['hours'], $_POST['description'], $_FILES['img'])) {
                            $name = cleanSQL($_POST['name']);
                            $price = cleanSQL($_POST['price']);
                            $hours = cleanSQL($_POST['hours']);
                            $description = cleanSQL($_POST['description']);
                            $imgName = uniqid();
                            move_uploaded_file($_FILES['img']['tmp_name'], "../coursesImg/$imgName.jpg");
                            $offlineCourseQuery = "UPDATE `offcou` SET `courseName` = '$name', `coursePrice` = '$price', `courseNumOfHours` = '$hours', `OffDis` = '$description' , `OffImage` = '$imgName' WHERE `offcou`.`OffId` = $OffId;";
                            $result = mysqli_query($db, $offlineCourseQuery);
                            if ($result) {
                                $errorMessage = "<br> <strong> Course has been Edited successfully </strong>";
                            } else {
                                $errorMessage = "<br> <Strong> Error has occured " . mysqli_error($db) . " nothing was affected";
                            }
                        }
                    } else if (isset($_POST['deleteData'])) {
                        $offId = cleanSQL($_POST['offId']);
                        $deleteQuery = "DELETE FROM `offcou` WHERE `offcou`.`OffId` = $offId";
                        $result = mysqli_query($db, $deleteQuery);
                        if ($result) {
                            $errorMessage = "<br><strong> Course has been deleted sucessfully </strong> ";
                        } else {
                            $errorMessage = "<br> <Strong> Error has occured " . mysqli_error($db) . " nothing was affected";
                        }
                    }
                    ?>
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
</html>