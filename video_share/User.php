<?php
require_once ('./Guest.php');
require_once ('./db_connect.php');
require_once('./startSession.php');
class User extends Guest {

	function editEmail($email){
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "UPDATE user SET email = '$email' WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			$this->lastSuccessMessage = "Email has been modified Successfully";
			return true;
		} else {
			$this->lastErrorMessage = "Something went wrong with editEmail";
			return false;
		}
	}

	function getVideosId(){
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM videos WHERE uploaderId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			return $result;
		} else {
			return false;
		}
	}

	function editPassword($newPassword){
		global $conn;
		$userId = $_SESSION['userId'];
		$password = md5($newPassword);
		$sql = "UPDATE user SET password = '$password' WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			$this->lastSuccessMessage = "Password has been modified Successfully";
			return true;
		} else {
			$this->lastErrorMessage = "Something went wrong with editPassword";
			return false;
		}
	}

	function editChannelName($newChannelName){
		global $conn;
		$userId = $_SESSION['userId'];
		$password = md5($newPassword);
		$sql = "UPDATE channel SET channelName = '$newChannelName' WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			$this->lastSuccessMessage = "Channel Name Has been modified";
			return true;
		} else {
			$this->lastErrorMessage = "Something went wrong with editPassword";
			return false;
		}
	}

	function editChannelImage($img){
		global $conn;
		$userId = $_SESSION['userId'];
		$channelImg = $this->getChannelImg();
		if($channelImg === false){
			$this->lastErrorMessage = $this->getLastErrorMessage();
			return false;
		}
		$sql = "SELECT * FROM channel WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			if($result->num_rows === 1){
				$channelRow = $result->fetch_assoc();
				$imgName = $channelRow['channelImg'];
				$from = $img['img']['tmp_name'];
				$to = "./images/$imgName.jpg";
				move_uploaded_file($from, $to);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function uploadVideo($video,$img,$videoTitle, $videoCategory, $videoKeywords) {
		global $conn;
		$channelId = $this->getChannelId($_SESSION['username']);
		$from = $video['video']['tmp_name'];
		$fromImg = $img['img']['tmp_name'];
		$videoLink = uniqid();
		$videoImg = $videoLink;
		$to = "./videos/$videoLink.mp4";
		$toImg = "./images/$videoLink.jpg";
		$uploaderId = $_SESSION['userId'];
		if (move_uploaded_file($from, $to)) {
			move_uploaded_file($fromImg, $toImg);
			$sql = "INSERT INTO  `videos` (`videoTitle`,`videoCategory`,`videoLink`,`videoKeywords`,`likes`,`views`,`videoDate`,`uploaderId`,`channelId`) VALUES ('$videoTitle','$videoCategory','$videoLink','$videoKeywords',0,0,CURDATE(),'$uploaderId','$channelId');";
			$result = $conn -> query($sql);
			if ($result !== false) {
				$this->lastSuccessMessage = "Video Uploaded Successfully";
				return true;
			} else {
				$this -> lastErrorMessage = "Something went wrong with uploadVideo";
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Error : Video wasn't uploaded Due to an Error : " . $_FILES['video']['error'];
			return false;
		}
	}

	function deleteVideo($videoId){
		global $conn;
		$deleteVideo = "DELETE FROM videos WHERE videoId='$videoId';";
		$result = $conn->query($deleteVideo);
		if($result !== false){
			$videoLink = $this->getVideoLink($videoId);
			unlink("/videos/$videoLink.mp4");
			$this->lastSuccessMessage = "Video Deleted Successfully";
			return true;
		} else {
			$this->lastErrorMessage = "Something went wrong with deleteVideo";
			return false;
		}

	}

	function getVideoLink($videoId){
		global $conn;
		$videoLinkQuery = "SELECT * FROM videos WHERE videoId ='$videoId';";
		$result = $conn->query($videoLinkQuery);
		if($result !== false){
			if($result->num_rows > 0){
				$videoRow = $result->fetch_assoc();
				return $videoRow['video'];
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function getChannelImg(){
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM channel WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			if ($result->num_rows > 0){
				$channelRow = $result->fetch_assoc();
				return $channelRow['channelImg'];
			} else {
				$this->lastErrorMessage = "Channel Not Found";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Error with getChannelImg";
			return false;
		}
	}

	function like($videoId) {
		$userId = $_SESSION['userId'];
		// Validation before like callback
		$sql = "INSERT INTO `like/dislike`(`userId`, `videoId`, `action`) VALUES ('$userId','$videoId',0);";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			// Update Video Likes +1
			$this->lastSuccessMessage = "Liked Video Successfully";
			return true;
		} else {
			$this -> lastErrorMessage = "Something went wrong with like";
			return false;
		}
	}

	function dislike($videoId) {
		$userId = $_SESSION['userId'];
		// Validation before callback
		$sql = "INSERT INTO `like/dislike`(`userId`, `videoId`, `action`) VALUES ('$userId','$videoId',1)";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			// Update videos Likes -1
			$this->lastSuccessMessage = "Disliked Video Successfully";
			return true;
		} else {
			$this -> lastErrorMessage = "Something went wrong with like";
			return false;
		}
	}

	function postComment($commentContent, $videoId) {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "INSERT INTO `comments`(`commentContent`, `commentDate`, `userId`,`videoId`) VALUES ('$commentContent',CURDATE(),'$userId','$videoId');";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			$this->lastSuccessMessage = "Comment has been posted";
			return TRUE;
		} else {
			$this -> lastErrorMessage = "Something went wrong with postComment";
			return false;
		}

	}

	/*function editComment($commentId, $commentContent) {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "UPDATE `comments` SET `commentContent`='$commentContent' ,`commentDate`=CURDATE() WHERE commentId='$commentId';";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			$this->lastSuccessMessage = "Comment Has been Edited";
			return true;
		} else {
			$this -> lastErrorMessage = "Something Went Wrong with editComment";
			return false;
		}
	}*/

	public function deleteComment($commentId) {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "DELETE FROM `comments` WHERE commentsId = '$commentId';";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			$this->lastSuccessMessage = "Comment Has been Deleted Successfully";
			return true;
		} else {
			$this -> lastErrorMessage = "Error With deleteComment";
			return false;
		}
	}

	function subscribe($channelId) {
		global $conn;
		$userId = $_SESSION['userId'];
		// Check before function callback
		$sql = "INSERT INTO `subscribtion` ( `userId`, `channelId`) VALUES ('$userId','$channelId')";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			// Update NumberOfFollowers +1
			$this -> updateFollowerNumber($channelId, '+');
			$this->lastSuccessMessage = "Subscribed Successfully";
			return true;
		} else {
			$this -> lastErrorMessage = "Something Went Wrong with subscribe";
			return false;
		}
	}

	function unSubscribe($channelId) {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "DELETE FROM `subscribtion` WHERE `userId`='$userId';";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			// Update Follower Count -1
			$this -> updateFollowerNumber($channelId, '-');
			$this -> lastSuccessMessage = "Unsubscribed successfully";
			return TRUE;
		} else {
			$this -> lastErrorMessage = "Something Went Wrong With unSubscribe";
			return false;
		}
	}

	function updateFollowerNumber($channelId, $action) {
		global $conn;
		$adder = ($action == '+') ? 1 : -1;
		$sql = "UPDATE `channel` SET `followerNumber`=(followerNumber)+($adder) WHERE channelId='$channelId';";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			return true;
		} else {
			$this -> lastErrorMessage = "Something Went Wrong With updateFollowerNumber";
			return false;
		}
	}

	function getSubscribtionState($channelId) {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM subscribtion WHERE channelId='$channelId' AND userId='$userId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Something went with getSubscribtionState";
			return false;
		}
	}

	function getSubscribtions() {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM channel JOIN subscribtion ON channel.channelId = subscribtion.channelId JOIN user ON channel.userId = user.userId WHERE subscribtion.userId='$userId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				return $result;
			} else {
				$this->lastErrorMessage = "You are not subscribed in any channel";
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with getSubscribtions";
			return false;
		}

	}

}
?>
