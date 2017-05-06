<?php
require_once("dbConnection.php"); // db connection import
require("adminCheck.php"); // verify admin login and do the checks there
$errorMessage;

function checkForErrors($articleTitle, $articleContent, $catagoryId, $img) { // check for the inputs for validation if something was invalid return false
    global $errorMessage;
    $noErrors = true;
    if (strlen($articleTitle) < 2) {
        $noErrors = false;
        $errorMessage = "<br><strong> Article Title Error min length 2 letters </strong>";
    }
    if (strlen($articleContent) < 2) {
        $noErrors = false;
        $errorMessage = "<br><strong> Article Content Error </strong>";
    }
    if (strlen($catagoryId) < 1) {
        $noErrors = false;
        $errorMessage = "<br><strong> CateogoryID Error </strong>";
    }
    if (!isset($img)) {
        $noErrors = false;
        $errorMessage = "<br><strong> Please select an article image </strong>";
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

if (isset($_POST['add'])) {
    if (checkForErrors($_POST['articleTitle'], $_POST['articleContent'], $_POST['catId'], $_FILES['img'])) {
        $articleTitle = cleanSQL($_POST['articleTitle']);
        $articleContent = cleanSQL($_POST['articleContent']);
        $catagoryId = cleanSQL($_POST["catId"]);
        $query = "INSERT INTO `art`( `ArtTitle`, `ArtContent`, `ArtTime`, `AdminId`, `CatId`,`likes`,`dislikes`) VALUES ('$articleTitle','$articleContent',NOW(),1,'$catagoryId',0,0);";
        $result = mysqli_query($db, $query);
        $errorMessage = "</br> <strong> Article has been added successfully </strong>";
        $imgId = mysqli_insert_id($db);
        move_uploaded_file($_FILES['img']['tmp_name'], "img/$imgId.jpg");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <!-- IE Combitability Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- Mobile First Meta -->
        <title>
        </title>
        <link rel="stylesheet" href="css/sstyle2.css">
        <link rel="stylesheet" href="css/bootstrap.css"> 
        <!-- Latest compiled and minified CSS -->
        <link href="css/hover.css" rel="stylesheet" media="all"> 
        <!-- Hover.CSS File -->
        <link rel="stylesheet" href="css/style.css"> 
        <!-- CSS File -->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
  <script src="js/html5shiv.min.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
    </head>
    <body>
        <!-- Type code below this line -->
        <div class="nav">
            <div class="container">
                <div class="link">
                    <!--
        <ul>
        <a href="#"><li>Add</li></a>
        <a href="#"><li>Edit/Delete</li></a>
        </ul>
                    -->
                    <h2>Add
                    </h2>
                    <hr>
                </div>
            </div>
            <div class="admin">
                <div class="container">
                    <form method="post" enctype="multipart/form-data" action = "addArticle.php"> 
                        <br>
                        <fieldset>
                            <input type="text" name="articleTitle" placeholder="Article Title" required>
                            <br>
                            <br>
                            <input type="file" id="fil"  class="file" name="img" accept=".png,.jpeg,.jpg,.bmp,.gif" required>
                            <br>
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
                            <br>
                            <br>
                            <textarea name="articleContent" placeholder="Article Content"></textarea> 
                            <br>
                            <br> 
                            <button name="add">Add
                            </button>
                            <br>
                            <br>
                        </fieldset>
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
        <script src="js/jquery.min.js">
        </script> 
        <!-- Jquery Mini file -->
        <script src="js/bootstrap.min.js">
        </script> 
        <!-- Latest compiled and minified JavaScript -->
        <script src="js/script.js">
        </script> 
        <!-- Externa Js File file - My File -->
    </body>
</html> 
