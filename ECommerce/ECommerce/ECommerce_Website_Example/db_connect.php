<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('antiSQL.php');
$servername = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "onlineshopping";
// Create connection
$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
/* check connection 
$currentCharSet = $conn->character_set_name();
$conn->set_charset($currentCharSet);
*/
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>