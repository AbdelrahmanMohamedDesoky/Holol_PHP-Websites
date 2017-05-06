<?php
require_once ('db_connect.php');
class Validation {
	protected $lastErrorMessage;
	public function getLastErrorMessage() {
		return $this -> lastErrorMessage;
	}

	public function validateLength($text, $length, $errorWord) {
		if (strlen($text) < $length) {
			$this -> $lastErrorMessage = "$errorWord can't be less than $length length";
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
					$this -> $lastErrorMessage = "Username already exists";
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
				$this -> $lastErrorMessage = "Email Isn't Valid";
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
				}
				return false;
			}
		} else {
			return false;
		}
	}

	
}
?>