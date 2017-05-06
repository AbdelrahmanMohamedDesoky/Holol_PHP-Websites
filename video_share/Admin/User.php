<?php
require_once ('./Guest.php');
require_once ('./db_connect.php');
class User extends Guest {
	function uploadVideo($videoTitle, $videoCategory, $videoKeywords, $channelId,$videoImg) {
		global $conn;
		$from = $_FILES['video']['tmp_name'];
		$videoLink = uniqid();
		$to = "/videos/$videoLink.mp4";
		$uploaderId = $_SESSION['userId'];
		if (move_uploaded_file($from, $to)) {
			$sql = "INSERT INTO  `videos` (`videoTitle`,`videoCategory`,`videoLink`,`videoImg`,`videoKeywords`,`likes`,`views`,`videoDate`,`uploaderId`,`channelId`) VALUES ('$videoTitle','$videoCategory','$videoLink','$videoImg','$videoKeywords',0,0,CURDATE(),'$uploaderId','$channelId');";
			$result = $conn -> query($sql);
			if ($result !== false) {
				$this->lastSuccessMessage = "Video Uploaded Successfully";
				return true;
			} else {
				$this -> lastErrorMessage = "Error : " . $conn -> error;
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
			
			$this->lastSuccessMessage = "Video Deleted Successfully";
			return true;
		} else {
			$this->lastErrorMessage = "Something went wrong with deleteVideo";
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
		$sql = "INSERT INTO `comments`(`commentContent`, `commentDate`, `userId`,`videoId`) VALUES ('$CommentContent',CURDATE(),'$userId','$videoId');";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			$this->lastSuccessMessage = "Comment has been posted";
			return TRUE;
		} else {
			$this -> lastErrorMessage = "Something went wrong with postComment";
			return false;
		}

	}

	function editComment($commentId, $commentContent) {
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
	}

	function deleteComment($commentId) {
		global $conn;
		$commentId;
		$userId = $_SESSION['userId'];
		$sql = "`DELETE FROM `comments` WHERE commentsId`=$commentId";
		$result = $conn -> query($sql);
		if ($result !== FALSE) {
			$this->lastSuccessMessage = "Comment Has been Deleted Successfully";
			return true;
		} else {
			$this -> lastErrorMessage = "Error : " . $conn -> error;
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
	// new start
	function getChannelId($username){
		global $conn;
		$sql = "SELECT * FROM channel JOIN user ON channel.userId = user.userId WHERE user.username = '$username';";
		$result = $conn->query($sql);
		if($result !== false){
			if ($result->num_rows > 0){
				$channelRow = $result->fetch_assoc();
				return $channelRow['channelId'];
			} else {
				return -1;
			}
		}
	}
	// new end
	function getChannelInfo($channelId) {
		global $conn;
		$sql = "SELECT * FROM channel WHERE channelId='$channelId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Something went wrong with getChannelInfo";
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
				return 1;
			} else {
				return 0;
			}
		} else {
			$this -> lastErrorMessage = "Something went with getSubscribtionState";
			return -1;
		}
	}

	function getSubscribtions() {
		global $conn;
		$userId = $_SESSION['userId'];
		$sql = "SELECT * FROM channel JOIN subscribtion ON channel.channelId = subscribtion.channelId WHERE channel.userId='$userId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				return $result;
			} else {
				return 0;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with getSubscribtions";
			return -1;
		}

	}

}
?>