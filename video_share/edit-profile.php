<?php
require_once('./loginCheck.php');
require_once('./startSession.php');
require_once('./User.php');
$user = new User();
$validator = new Validation();
if(isset($_POST['editEmail'])){
  if(!empty(cleanSQL($_POST['email']))){
    if($validator->validateEmail(cleanSQL($_POST['email']))){
      if($user->editEmail($_POST['email'])){
        notify("Success",$user->getLastSuccessMessage());
      } else {
        notify("Error",$user->getLastErrorMessage());
      }
    } else {
      notify("Error",$validator->getLastErrorMessage());
    }
  } else {
    notify("Error","Email Address Can not be Empty");
  }
} // edit Email ( edit profile )
else if (isset($_POST['editPassword'])){
  if(!empty($_POST['password']) && !empty($_POST['password_confirm'])){
    if($validator->validateLength($_POST['password'],6,"Password") &&
       $validator->validateLength($_POST['password_confirm'],6,"Confirm Password")){
         if($_POST['password'] == $_POST['password_confirm']){
           if($user->editPassword($_POST['password'])){
             notify("Success",$user->getLastSuccessMessage());
           } else {
             notify("Error",$user->getLastErrorMessage());
           }
         } else {
           notify("Error","Passwords does not match");
         }
    } else {
      notify("Error",$validator->getLastErrorMessage());
    }
  } else {
    notify("Error","Passwords can not be empty");
  }
}
else if (isset($_POST['editChannelName'])){
  if(!empty(cleanSQL($_POST['channelName']))){
    if($validator->validateLength(cleanSQL($_POST['channelName']),6,"Channel Name")){
      if($user->editChannelName(cleanSQL($_POST['channelName']))){
        notify("Success",$user->getLastSuccessMessage());
      } else {
        notify("Error",$user->getLastErrorMessage());
      }
    } else {
      notify("Error",$validator->getLastErrorMessage());
    }
  } else {
    notify("Error","Channel Name can not be empty");
  }
}
else if (isset($_POST['editChannelImage'])){
  if(!empty($_FILES['img']['tmp_name'])){
    if($validator->validateImage($_FILES)){
      $from = $_FILES['img']['tmp_name'];
      $channelImg = $user->getChannelImg();
      $to = "./images/$channelImg.jpg";
      if(move_uploaded_file($from,$to)){
        notify("Success","Channel Image was Updated");
      } else {
        notify("Error","Error code : " + $_FILES['img']['error']);
      }
    } else {
      notify("Error",$validator->getLastErrorMessage());
    }
  } else {
    notify("Error","Image was not uploaded please upload it first");
  }
}
else if (isset($_POST['deleteVideo'])){
  if(!empty(cleanSQLNumbers($_POST['videoId']))){
    if($validator->validateVideoPermissions(cleanSQLNumbers($_POST['videoId']),$_SESSION['userId'])){
      if($user->deleteVideo(cleanSQLNumbers($_POST['videoId']))){
        notify("Success",$user->getLastSuccessMessage());
      } else {
        notify("Error",$user->getLastErrorMessage());
      }
    } else {
      notify("Error",$validator->getLastErrorMessage());
    }
  } else {
    notify("Error","Please Select a video before deletion");
  }
}
else if (isset($_POST['editProfileImg'])){
  if($validator->validateImage($_FILES)){
    $from = $_FILES['img']['tmp_name'];
    $username = $_SESSION['username'];
    $to = "./images/$username.jpg";
    if(move_uploaded_file($from,$to)){
      notify("Success","Profile Image was updated");
    } else {
      notify("Error","Profile Image was not updated error code : " + $_FILES['img']['error']);
    }
  } else {
    notify("Error",$validator->getLastErrorMessage());
  }
}
?>
