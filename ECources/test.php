<?php

function cleanSQL($text) {
    $cleanText = str_replace("/", "", $text);
    $cleanText = str_replace("\\", "", $cleanText);
    $cleanText = str_replace("'", "", $cleanText);
    $cleanText = str_replace("\"", "", $cleanText);
    $cleanText = str_replace("`", "", $cleanText);
    $cleanText = str_replace("=", "", $cleanText);
    $cleanText = str_replace(".", "", $cleanText);
    $cleanText = str_replace("!", "", $cleanText);
    $cleanText = str_replace("|", "", $cleanText);
    $cleanText = str_replace("*", "", $cleanText);
    $cleanText = str_replace(";", "", $cleanText);
    $cleanText = str_replace("-", "", $cleanText);
	$cleanText = str_replace("%", "", $cleanText);
    $cleanText = stripslashes($cleanText);
    return $cleanText;
}

if (isset($_GET['submit'])) {
    echo "Original Query = " . $_GET['text'];
    echo "<br>";
    echo "Cleaned Query = " . cleanSQL($_GET['text']);
}
?>

<html>
    <form action ='test.php' method = "GET">
        <input type = 'text' name = 'text'>
        <input type = 'submit' value ='troll start' name = 'submit'>
    </form>
</html>