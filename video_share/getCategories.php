<?php
require_once './Guest.php';
$guest = new Guest();
$result = $guest -> getCategories();
while ($categoryRow = $result -> fetch_assoc()) {
	$categoryId = $categoryRow['categoryId'];
	$categoryName = $categoryRow['categoryName'];
	echo "<li><a < href='category_result.php?id=$categoryId' >$categoryName</a></li>";
}
?>

