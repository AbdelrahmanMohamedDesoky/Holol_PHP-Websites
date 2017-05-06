<?php
/* 

select id,numbers_from,created_date,amount_numbers,SMS_text 
from Test_Table
where 
created_date <= 'CURDATE()'


*/
require_once ("User.php");
class Admin extends User {

	protected $lastErrorMessage;

	function deleteChannel($channelId) {
		global $conn;
		$deleteQuery = "DELETE c, v FROM channel c  LEFT JOIN  videos v ON c.channelId = v.channelId WHERE `channelId`=$channelId";

		$result = $conn -> query($deleteQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
		}
	}

	function deleteComment($commentId) {
		global $conn;
		$deleteQuery = "DELETE FROM comments WHERE commentsId=$commentId";

		$result = $conn -> query($deleteQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
		}
	}

	function addCategory($categoryName) {
		global $conn;
		$categoryQuery = "INSERT INTO category (`categoryName`) VALUES('$categoryName');";
		$result = $conn -> query($categoryQuery);
		if ($result !== false) {// query success
			return true;
		} else {// query fail
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}

	function editCategory($categoryId, $categoryName) {
		global $conn;
		$editQuery = "UPDATE category SET `categoryName` = '$categoryName' WHERE categoryId=$categoryId;";
		$result = $conn -> query($editQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}

	function deleteCategory($categoryId) {
		global $conn;
		$deleteQuery = "DELETE c, v FROM category c LEFT JOIN  videos v ON c.categoryId = v.VideoCategory  WHERE  c.categoryId = '$categoryId'";

		$result = $conn -> query($deleteQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
		}
	}

	function showUsers() {
		global $conn;
		$usersQuery = "SELECT * FROM user;";
		$result = $conn -> query($usersQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Error : " . $conn -> error;
			return false;
		}
	}

	function showNewComments(){
       global $conn;
		$usersQuery = "SELECT * FROM comments WHERE commentDate =CURDATE;";
		$result = $conn -> query($usersQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Error : " . $conn -> error;
			return false;
		}
	}
	
	function showVideoReport(){
		global $conn;
		$usersQuery = "SELECT * FROM reportedvideos;";
		$result = $conn -> query($usersQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Error : " . $conn -> error;
			return false;
		}
	}
	
	function showCommentReport(){
		global $conn;
		$usersQuery = "SELECT * FROM reportedcomment;";
		$result = $conn -> query($usersQuery);
		if ($result !== false) {
			return $result;
		} else {
			$this -> lastErrorMessage = "Error : " . $conn -> error;
			return false;
		}
	}
	
	function blockUser($userId) {
		global $conn;
		$blockQuery = "UPDATE user SET blockState = 1 WHERE userId = '$userId';";
		$result = $conn -> query($blockQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}

	function unBlockUser($userId) {
		global $conn;
		$unBlockQuery = "UPDATE user SET blockState = 0 WHERE userId = '$userId';";
		$result = $conn -> query($unBlockQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}

	function videoReportAction ($action,$reportId){
		global $conn;
		$editQuery = "UPDATE reportedvideos SET action=$action WHERE reportId=$reportId;";
		$result = $conn -> query($editQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}

    function commentReportAction ($action,$reportId){
		global $conn;
		$editQuery = "UPDATE reportedcomment SET action=$action WHERE reportId=$reportId;";
		$result = $conn -> query($editQuery);
		if ($result !== false) {
			return true;
		} else {
			$this -> lastErrorMessage = "Database Error : " . $conn -> error;
			return false;
		}
	}
	
	
	}
?>