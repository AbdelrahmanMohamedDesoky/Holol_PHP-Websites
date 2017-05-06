<?php
require_once ('./db_connect.php');
class Guest {
	protected $lastErrorMessage;
	protected $lastSuccessMessage;

	public function getLastErrorMessage() {
		return $this -> lastErrorMessage;
	}

	public function getLastSuccessMessage() {
		return $this -> lastSuccessMessage;
	}

	public function signin($username, $password) {
		global $conn;
		$password = md5($password);
		$loginQuery = "SELECT * FROM user WHERE username='$username' AND password='$password';";
		$result = $conn -> query($loginQuery);
		if ($result !== false) {
			if ($result -> num_rows == 1) {
				$usernameRow = $result -> fetch_assoc();
				$_SESSION['blockState'] = ($usernameRow['blockState'] == 1) ? true : false;
				if ($_SESSION['blockState']) {
					$this -> lastErrorMessage = "You are Blocked, You are not Welcomed anymore.";
					session_destroy();
					return false;
				}
				$_SESSION['username'] = $username;
				$_SESSION['userId'] = $usernameRow['userId'];
				$_SESSION['userType'] = $usernameRow['userType'];
				$this -> lastSuccessMessage = "Successfully Logged In";
				return true;
			} else {
				$this -> lastErrorMessage = "Invalid Username/Password ";
				return false;
			}
		}
	}

	public function signup($username, $email, $password) {
		$conn = new mysqli('localhost', 'root', '', 'video_share');
		$password = md5($password);
		$signupQuery = "INSERT INTO user VALUES (NULL,'$username','$password','$email',0,NULL);";
		$result = $conn->query($signupQuery);
		if ($result !== false) {
			$userIdInserted = $conn->insert_id;
			$channelImg = uniqid();
			$signupQueryInsert = "INSERT INTO channel VALUES (NULL,'$username Channel','0','$channelImg',$userIdInserted);";
			$resultInsert = $conn->query($signupQueryInsert);
			$this -> lastSuccessMessage = "Successfully Signed Up";
			$conn->close();
			return true;
		} else {
			$this -> lastErrorMessage = "Something went wrong with the signup";
			$conn->close();
			return false;
		}
	}

	function getChannelId($username) {
		global $conn;
		$sql = "SELECT * FROM channel JOIN user ON channel.userId = user.userId WHERE user.username = '$username';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				$channelRow = $result -> fetch_assoc();
				return $channelRow['channelId'];
			} else {
				return -1;
			}
		} else {
			$this->lastErrorMessage = "Something went wrong with getChannelId";
			return -1;
		}
	}

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

	public function viewVideo($videoLink) {
		global $conn;
		if ($this -> increaseViewCount($videoLink)) {
			$sql = "SELECT * FROM videos JOIN user ON videos.uploaderId = user.userId WHERE videoLink='$videoLink';";
			$result = $conn -> query($sql);
			if ($result !== false) {
				return $result;
			} else {
				$this -> lastErrorMessage = "Error with viewVideo";
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with viewVideo";
			return false;
		}
	}

	public function getVideosByChannelId($channelId) {
		global $conn;
		$sql = "SELECT * FROM videos JOIN user ON videos.uploaderId = user.userId WHERE channelId='$channelId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Something went wrong with getVideosByChannelId";
			return false;
		}
	}

	public function getVideosByCategory($categoryId) {
		global $conn;
		$videosQuery = "SELECT * FROM videos JOIN user ON videos.uploaderId = user.userId WHERE videos.videoCategory='$categoryId';";
		$result = $conn -> query($videosQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Something went wrong with getVideosBycategory";
			return false;
		}
	}

	public function searchForVideoTitle($videoTitle) {
		global $conn;
		$sql = "SELECT * FROM videos JOIN user ON videos.uploaderId = user.userId WHERE videoTitle LIKE '%$videoTitle%' OR videoKeywords LIKE '%$videoTitle%';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				$numOfResult = $result -> num_rows;
				$this -> lastSuccessMessage = "Found $numOfResult videos";
				return $result;
			} else {
				$this -> lastErrorMessage = "No Videos Were found with that name";
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with searchForVideoTitle";
				return false;
		}
	}

	public function getRecentVideos() {
		global $conn;
		$sql = "SELECT * FROM videos JOIN user on videos.UploaderId = user.userId";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Something Went wrong with getRecentVideos";
			return false;
		}
	}

	public function getCategories() {
		global $conn;
		$sql = "SELECT * FROM category;";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Something went wrong with getCategories";
			return false;
		}
	}

	public function getCategoryName($categoryId) {
		global $conn;
		$sql = "SELECT * FROM category WHERE categoryId = '$categoryId';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				$categoryRow = $result -> fetch_assoc();
				return $categoryRow['categoryName'];
			} else {
				$this -> lastErrorMessage = "Category Not Found";
				return false;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with getCategoryName";
			return false;
		}
	}

	public function getUserName ($userId){
		global $conn;
		$sql = "SELECT * FROM user WHERE userId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			if($result->num_rows > 0){
				$userRow = $result->fetch_assoc();
				return $userRow['username'];
			}
		}
	}
	public function getCommentsByVideoLink($videoLink) {
		global $conn;
		$sql = "SELECT * FROM comments JOIN videos ON comments.videoId = videos.videoId WHERE videoLink = '$videoLink';";
		$result = $conn->query($sql);
		if($result !== false){
			return $result;
		}
	}

	private function increaseViewCount($videoLink) {
		global $conn;
		$sql = "UPDATE videos SET views = views+1 WHERE videoLink='$videoLink';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Video Not Found";
			return false;
		}
	}

}
?>
