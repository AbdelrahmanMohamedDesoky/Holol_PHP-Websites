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
				$usernameRow = $result->fetch_assoc();
				$_SESSION['username'] = $username;
				$_SESSION['userId'] = $usernameRow['userId'];
				$_SESSION['userType'] = $usernameRow['userType'];
				$_SESSION['blockState'] = ($usernameRow['blockState'] == 1) ? true : false;
				if($_SESSION['blockState']){
					$this->lastErrorMessage = "You are Banned";
					session_destroy();
					return false;
				}
				$this -> lastSuccessMessage = "Successfully Logged In";
				return true;
			} else {
				$this -> lastErrorMessage = "Invalid Username/Password ";
				return false;
			}
		}
	}

	public function signup($username, $email, $password) {
		global $conn;
		$password = md5($password);
		$signupQuery = "INSERT INTO user VALUES (NULL,'$username','$password','$email',0,NULL);";
		$result = $conn -> query($signupQuery);
		if ($result !== false) {
			$this -> lastSuccessMessage = "Successfully Signed Up";
			return true;
		} else {
			$this -> lastErrorMessage = "Something went wrong with the signup";
			return false;
		}
	}

	public function viewVideo($videoLink) {
		global $conn;
		if ($this -> increaseViewCount($videoLink)) {
			return "<video controls>
				<source src='./videos/$videoLink.mp4' type='video/mp4'>
				Your browser does not support HTML5 video.
				</video>";
		} else {
			$this -> lastErrorMessage = "Something went wrong with viewVideo";
			return false;
		}
	}

	public function getVideosByCategory($categoryId) {
		global $conn;
		$videosQuery = "SELECT * FROM videos WHERE videoCategory='$categoryId';";
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
		$sql = "SELECT * FROM videos WHERE videoTitle='$videoTitle';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			if ($result -> num_rows > 0) {
				$numOfResult = $result-> num_rows;
				$this->lastSuccessMessage = "Found $numOfResult videos";
				return $result;
			} else {
				$this -> lastErrorMessage = "No Videos Were found with that name";
				return 0;
			}
		} else {
			$this -> lastErrorMessage = "Something went wrong with searchForVideoTitle";
			return -1;
		}
	}

	public function getRecentVideos(){
		global $conn;
		$sql = "SELECT * FROM videos JOIN user on videos.UploaderId = user.userId";
		$result = $conn->query($sql);
		if($result !== false){
			return $result;
		} else {
			$this->lastErrorMessage =  "Something Went wrong with getRecentVideos";
			return false;
		}
	}
	
	private function increaseViewCount($videoLink) {
		global $conn;
		$sql = "UPDATE videos SET views = views+1 WHERE videoLink='$videoLink';";
		$result = $conn -> query($sql);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Something went wrong with increaseViewCount";
			return false;
		}
	}
      
	function getCategories() {
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

}
?>