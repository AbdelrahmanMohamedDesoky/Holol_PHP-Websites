<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('upload_max_filesize', 524288000);
ini_set('post_max_size',524288000);
require_once('antiSQL.php');
require_once('Validation.php');
$servername = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "video_share";
// Create connection
$conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);
//check connection
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>
