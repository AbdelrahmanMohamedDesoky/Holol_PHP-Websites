<?php
require_once ('db_connect.php');
class Validation {
	protected $lastErrorMessage;
	public function getLastErrorMessage() {
		return $this -> lastErrorMessage;
	}

	public function validateLength($text, $length, $errorWord) {
		if (strlen($text) < $length) {
			$this -> lastErrorMessage = "$errorWord can not be less than $length length";
			return false;
		}
		return true;
	}

	public function validateUsername($username) {
		if ($this -> validateLength($username, 6, "username")) {
			global $conn;
			$usernameQuery = "SELECT * FROM user WHERE username = '$username';";
			$result = $conn -> query($usernameQuery);
			if ($result !== false) {
				if ($result -> num_rows > 0) {
					$this -> lastErrorMessage = "Username already exists";
					return false;
				}
				return true;
			}
		} else {
			return false;
		}
	}

	public function validateEmail($email) {
		if ($this -> validateLength($email, 6, "email")) {
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
				$this -> lastErrorMessage = "Email Is not Valid";
				return false;
			} else {
				global $conn;
				$emailQuery = "SELECT * FROM user WHERE email = '$email';";
				$result = $conn -> query($emailQuery);
				if ($result !== false) {
					if ($result -> num_rows > 0) {
						$this -> lastErrorMessage = "Email already exists";
						return false;
					} else {
						return true;
					}
				} else {
					$this->lastErrorMessage = "Error with ValidateEmail";
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function validateBeforeUpload($super,$videoTitle,$categoryId){
		if(empty($super['img']['tmp_name'])){
			$this->lastErrorMessage = "Image was not uploaded";
			return false;
		}
		else if(empty($super['video']['tmp_name'])){
			$this->lastErrorMessage = "Video was not uploaded Error Code " . $super['video']['error'];
			return false;
		}
		else if(strpos($super['img']['type'],'image') === false){
			$this->lastErrorMessage = "Image was not a real image file";
			return false;
		}
		else if(strpos($super['video']['type'],'video/mp4') === false){
			$this->lastErrorMessage = "Only mp4 vidoes are allowed please convert to other extentions";
			return false;
		}
		else if(!$this->validateLength($videoTitle,6,"Video Title")){
			return false;
		}
		else if(!$this->validateLength($categoryId,1,"Category Id")){
			return false;
		}
		else {
			return true;
		}
	}

	public function validateImage($super){
		if(empty($super['img']['tmp_name'])){
			$this->lastErrorMessage = "Image was not uploaded Error Code " . $super['img']['error'];
			return false;
		}
		else if(strpos($super['img']['type'],'image') === false){
			$this->lastErrorMessage = "Image was not a real image file";
			return false;
		}
		else {
			return true;
		}
	}

	public function validateVideoPermissions($videoId,$userId){
		global $conn;
		$sql = "SELECT * FROM videos WHERE  videoId = '$videoId' AND uploaderId = '$userId';";
		$result = $conn->query($sql);
		if($result !== false){
			if($result->num_rows > 0){
				return true;
			} else {
				$this->lastErrorMessage = "Video not found or invalid video id";
				return false;
			}
		} else {
			$this->lastErrorMessage = "Something went wrong with validateVideoPermissions";
			return false;
		}
	}

	public function validateCommentId($commentId,$userId){
		global $conn;
		$sql = "SELECT * FROM comments WHERE userId='$userId' AND commentsId='$commentId';";
		$result = $conn->query($sql);
		if($result !== false){
			if ($result->num_rows == 1){
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

}
?>
