<?php
$myUser = new User();
if(isset($_POST['subscribe'])){
  if(!empty(cleanSQL($_POST['channelId']))){
      if($myUser->subscribe($myUser->getChannelId(cleanSQL($_POST['channelId'])))){
        notify("Success",$myUser->getLastSuccessMessage());
    } else {
        notify("Error",$myUser->getLastErrorMessage());
    }
  } else {
    notify("Error","Channel Id is empty");
  }
}
else if (isset($_POST['unsubscribe'])){
  if(!empty(cleanSQL($_POST['channelId']))){
    if($myUser->unsubscribe($myUser->getChannelId(cleanSQL($_POST['channelId'])))){
      notify("Success",$myUser->getLastSuccessMessage());
  } else {
      notify("Error",$myUser->getLastErrorMessage());
    }
  } else {
  notify("Error","Channel Id is empty");
  }
}
?>
