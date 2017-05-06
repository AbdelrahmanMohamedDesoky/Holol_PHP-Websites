<?php
require("adminCheck.php");
require("dbConnection.php");
$errorMessage = "";

function checkForErrors($category) {
    global $db;
    global $errorMessage;
    $noError = true;
    if (strlen($category) < 2 || strlen($category) > 30) {
        $noError = false;
        $errorMessage = "<br> <strong> Category name is too short or too long max 30 chars </strong>";
    }
    return $noError;
}

if (isset($_POST['Add'])) {
    $category = cleanSQL($_POST['category']);
    if (checkForErrors($category)) {
        $categoryQuery = "INSERT INTO `category` (`CatId`, `CatName`) VALUES (NULL, '$category');";
        $result = mysqli_query($db, $categoryQuery);
        if ($result) {
            $errorMessage = "<br><strong> Category has been added </strong>";
        } else {
            $errorMessage = "<br><strong> Error has occured & Error = " . mysqli_error($db) . "</strong>";
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
        <link href="css/style2.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body> 
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="addCategory.php">Add Category</a></li>
            <li role="presentation"><a href="editCategory.php">Edit Category</a></li>
        </ul>
        <div class="admin">
            <div class="container">
                <form action ="addCategory.php" method = "POST">
                    Category :
                    <input type= "text" name="category" placeholder="Category Name" required>
                    <br><br>
                    <button name="Add"> Add </button>
                    <!--           <button name="Edit"> Edit</button>  -->
                </form>
                <?php
                if (isset($errorMessage) && $errorMessage != NULL) {
                    echo $errorMessage;
                    $errorMessage = NULL;
                }
                ?>
                </br> </br> <a href="index.php">Admin Home Page</a> </br> </br>
            </div>
        </div>
        <script src="js/jquery-1.12.1.min.js"></script> 
        <!-- Jquery Mini file -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
    </body>