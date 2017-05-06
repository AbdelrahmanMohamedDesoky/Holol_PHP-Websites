<!DOCTYPE html>
<html lang="en">
<head>
<title>Users</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container_fluid">
		<!--<h2>Striped Rows</h2>-->
		<form action="AdminAction.php" method="post">
			<table class='table table-striped'>
				<thead>
					<tr>
						<th>userId</th>
						<th>username</th>
						<th>email</th>
						<th>nationalId</th>
						<th>userType</th>
						<th>blockState</th>
					</tr>
				</thead>
				<tbody>
<?php
require 'Admin.php';

$admin = new Admin ();

$result = $admin->showUsers ();
/*
 *
 * SELECT `userId`, `username`, `email`, `password`, `nationalId`, `userType`, `blockState` FROM `user` WHERE 1
 */
if ($result->num_rows > 0) {
	// output data of each row
	while ( $row = $result->fetch_assoc () ) {
		echo " <tr>
        <td><input type='radio' name='userId' style='width:30px;height:30px;' value='" . $row ['userId'] . "'style='width:200px;height:200px;'></td>
        <td>" . $row ['username'] . "</td>
        <td>" . $row ['email'] . "</td>
        <td>" . $row ['nationalId'] . "</td>
        <td>" . $row ['userType'] . "</td>
        <td>" . $row ['blockState'] . "</td>
       
      </tr>";
	}
} else {
	echo "0 results";
}

?>
</tbody>
			</table>
			<center>
			<?php
			if ($_GET ['type'] == 1) {
				echo "<input class='btn' style='background-color: #4347d2; color: #fff;'
					type='submit' name='blockUser' value='Block User' />";
			} else if ($_GET ['type'] == 2) {
				echo "<input class='btn' style='background-color: #4347d2; color: #fff;'
					type='submit' name='unBlockUser' value='UnBlock User' />";
			}
			?>
				
				
			</center>
		</form>
	</div>
</body>
</html>
