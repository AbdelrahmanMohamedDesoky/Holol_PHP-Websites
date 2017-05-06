<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','videoshare');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
//SELECT `userId`, `username`, `password`, `email`, `userType`, `blockState` FROM `user` WHERE 1
$sql="SELECT * FROM user WHERE userId = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>username</th>
<th>email</th>
<th>userType</th>
<th>blockState</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['userType'] . "</td>";
    echo "<td>" . $row['blockState'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>