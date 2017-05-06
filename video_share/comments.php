<?php
require_once('./User.php');
$myUser = new User();
$validator = new Validation();
if(isset($_POST['postComment'])){
  if($validator->validateLength(cleanSQL($_POST['commentContent']),6,"Comment")){
    if($myUser->postComment(cleanSQL($_POST['commentContent']),cleanSQLNumbers($_POST['videoId']))){
      notify("Success",$myUser->getLastSuccessMessage());
    } else {
      notify("Error",$myUser->getLastErrorMessage());
    }
  } else {
    notify("Error",$validator->getLastErrorMessage());
  }
}
else if (isset($_POST['deleteComment'])){
  if(!empty(cleanSQLNumbers($_POST['commentId']))){
    $commentId = cleanSQLNumbers($_POST['commentId']);
    if($validator->validateCommentId($commentId,$_SESSION['userId'])){
      if ($myUser->deleteComment($commentId)){
        notify("Success",$myUser->getLastSuccessMessage());
      } else {
        notify("Error",$myUser->getLastErrorMessage());
      }
    } else {
      notify("Error","This is not your comment");
    }
  } else {
    notify("Error","Comment id is empty");
  }
}
?>
