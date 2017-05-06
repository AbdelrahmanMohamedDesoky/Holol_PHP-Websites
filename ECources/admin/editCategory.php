<?php
require("dbConnection.php");
require("adminCheck.php");
$errorMessage = "";

function checkForErrors($newCategoryName) {
    $noErrors = true;
    global $errorMessage;
    if (!isset($newCategoryName) || strlen($newCategoryName) < 2 || strlen($newCategoryName) > 30) {
        $noErrors = false;
        $errorMessage = "<br> <strong> Please check the new category name max 30 chars </strong> ";
    }
    return $noErrors;
}

if (isset($_POST['edit'])) {
    // edit button was pressed
    $catId = cleanSQL($_POST['catId']);
    $categoryName = cleanSQL($_POST['categoryName']);
    if (checkForErrors($categoryName)) {
        $categoryNameQuery = "UPDATE `category` SET `CatName` = '$categoryName' WHERE `category`.`CatId` = $catId;";
        $result = mysqli_query($db, $categoryNameQuery);
        if ($result) {
            $errorMessage = "<br> <strong> Category Name has been edited successfully </strong>";
        } else {
            $errorMessage = "<br> <strong> An error occured while edited and error is : " . mysqli_error($db) . "</strong>";
        }
    }
} else if (isset($_POST['delete'])) {
    $catId = cleanSQL($_POST['catId']);
    $categoryDeleteQuery = "DELETE FROM category WHERE CatId='$catId';";
    $result = mysqli_query($db, $categoryDeleteQuery);
    if ($result) {
        $errorMessage = "<br> <strong> Category has been deleted successfully </strong>";
    } else {
        $errorMessage = "<br> <strong> An error occured while deleting and error is : " . mysqli_error($db) . "</strong>";
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
            <li role="presentation" class="">
                <a href= "addCategory.php">Add Category</a>
            </li>
            <li role="presentation" class="active">
                <a href= "editCategory.php">Edit Category</a>
            </li>
        </ul>
        <div class="admin">
            <div class="container">
                <form action = "editCategory.php" method = "POST">
                    Choose Category :
                    <select name = "catId">
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
                    </select>
                    <br> <br>
                    <textarea name="categoryName" placeholder="New Category Name" required></textarea> <br>
                    <button name="edit" >Edit</button>
                    <button name="delete" >Delete</button>
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
    </div>
    <script src="js/jquery-1.12.1.min.js"></script> 
    <!-- Jquery Mini file -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
</body>