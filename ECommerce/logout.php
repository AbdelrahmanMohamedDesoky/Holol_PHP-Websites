<?php
if(!isset($_SESSION)){
session_start();	
}
session_unset(); 
// destroy the session 
session_destroy();
header("Location: index.php");
?>