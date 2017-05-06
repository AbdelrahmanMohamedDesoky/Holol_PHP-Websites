<?php
require_once('./startSession.php');
if(empty($_SESSION['username'])){
	header("Location: ./index.php");
}
