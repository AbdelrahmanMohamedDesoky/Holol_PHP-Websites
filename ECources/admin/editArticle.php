<?php
require_once("dbConnection.php");
require("adminCheck.php");
if (isset($_POST['search'])) {
    // search is pressed.
    $articleTitle = cleanSQL($_POST['articleTitle']);
    $query = "SELECT ArtContent FROM art WHERE ArtTitle='$articleTitle';";
    $result = mysqli_query($db, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $articleContent = mysqli_fetch_array($result);
        $htmlArticleContent = $articleContent['ArtContent'];
        $htmlOldTitle = "<input type = 'hidden' name = 'oldTitle' value = '$articleTitle'>";
    } else {
        // No Articles were found with that title.
        $errorMessage = "</br> <strong> No Articles were found with that title. </strong>";
    }
} else if (isset($_POST['edit'])) {
    // edit is pressed.
    if(strlen($_POST['oldTitle']) < 2){
        $errorMessage = "</br> <strong> Please search first for that article </strong>";
    } else {
    $content = cleanSQL($_POST['articleContent']);
    $oldArticeTitle = cleanSQL($_POST['oldTitle']);
    $articleTitle = cleanSQL($_POST['articleTitle']);
    $contentQuery = "UPDATE art SET ArtTitle='$articleTitle', ArtContent='$content' WHERE ArtTitle='$oldArticeTitle';";
    $searchQuery = "SELECT ArtTitle FROM art WHERE ArtTitle='$articleTitle';";
    $searchResult = mysqli_query($db, $searchQuery);
    if ($searchResult && mysqli_num_rows($searchResult) == 1) {
        $resultContent = mysqli_query($db, $contentQuery);
        if ($resultContent) {
            $errorMessage = "</br> <strong> Article has been Edited Successfully </strong>";
        }
    } else {
        $errorMessage = "</br> <strong> No Articles were found with that title. </strong>";
    }
    $oldArticleTitle = NULL;
    }
} else if (isset($_POST['delete'])) {
    $articleTitle = cleanSQL($_POST['articleTitle']);
    $searchQuery = "SELECT ArtTitle FROM art WHERE ArtTitle='$articleTitle';";
    $searchResult = mysqli_query($db, $searchQuery);
    if ($searchResult && mysqli_num_rows($searchResult) == 1) {
        $delete = "DELETE FROM art WHERE ArtTitle = '$articleTitle';";
        $deleteResult = mysqli_query($db, $delete);
        if ($deleteResult) {
            $errorMessage = "</br> <strong> Article has been deleted from the DB </strong>";
        } else {
            $errorMessage = "</br> <strong> Error while deleting the article & Error = $delete " . mysqli_error($db) . "</strong>";
        }
    } else {
        $errorMessage = "</br> <strong> No Articles were found with that title. </strong>";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <!-- IE Combitability Meta -->
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <!-- Mobile First Meta -->
        <title></title>
        <link href="css/sstyle2.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Latest compiled and minified CSS -->
        <link href="css/hover.css" media="all" rel="stylesheet">
        <!-- Hover.CSS File -->
        <!--            <link rel="stylesheet" href="css/style.css">  CSS File -->
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
                    <h3>Edit/Delete</h3>
                    <hr>
                </div>
            </div>
            <div class="admin">
                <div class="container">
                    <form action="editArticle.php" method="POST">
                        <br>
                        <fieldset>
                            <input name="articleTitle" placeholder=
                                   "Type ArticleTitle Here" type="text" value="<?php
if (isset($articleTitle)) {
    echo $articleTitle;
}
?>"required>
                            <button name="search">search</button><br>
                            <br>
                            <textarea name="articleContent"><?php
                                   if (isset($htmlArticleContent)) {
                                       echo $htmlArticleContent;
                                   }
?></textarea><br>
                            <br>
                            <?php
                            if (isset($htmlOldTitle)) {
                                echo $htmlOldTitle;
                            }
                            ?>
                            <button name="edit">Edit</button>
                            <button name="delete">Delete</button>
                        </fieldset>
                    </form>
                    <?php
                    if (isset($errorMessage)) {
                        echo $errorMessage;
                        $errorMessage = NULL;
                    }
                    ?>
                    </br> </br> <a href="index.php">Admin Home Page</a> </br> </br>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js">
        </script> <!-- Jquery Mini file -->

        <script src="js/bootstrap.min.js">
        </script> <!-- Latest compiled and minified JavaScript -->

        <script src="js/script.js">
        </script> <!-- Externa Js File file - My File -->
    </body>
</html>