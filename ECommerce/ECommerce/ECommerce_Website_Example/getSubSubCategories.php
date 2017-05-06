<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
require ("db_connect.php");
$subId = (int)$_GET ['subId'];
$subSubQuery = "SELECT * FROM subsubcategory WHERE subId = '$subId';";
$result = $conn->query ( $subSubQuery );
if ($result->num_rows >= 1) {
	echo "<select name = 'subSubId''>";
	echo "<option value='-1'>Optional : Select SubSubCategory</option>";
	while ( $row = $result->fetch_assoc() ) {
		$subSubName = $row ['subSubName'];
		$subSubId = $row ['subSubId'];
		echo "<option value='$subSubId'>$subSubName</option>";
	}
	echo "</select>";
} else {
	echo "<select name = 'subSubId'>";
	echo "<option value='-1'>Optional : Select SubSubCategory</option>";
	echo "</select>";
}
?>
</body>
</html>