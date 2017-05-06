<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
require ("db_connect.php");
$categoryId = (int) $_GET ['categoryId'];
$subQuery = "SELECT * FROM subcategory WHERE categoryId = '$categoryId';";
$result = $conn->query ( $subQuery );
if ($result->num_rows >= 1) {
	echo "<select name = 'subId' onchange='showSubSubCategories(this.value)'>";
	echo "<option value=''>Select SubCategory</option>";
	while ( $row = $result->fetch_assoc() ) {
		$subName = $row ['subName'];
		$subId = $row ['subId'];
		echo "<option value='$subId'>$subName</option>";
	}
	echo "</select>";
} else {
	echo "No Results";
}
?>
</body>
</html>