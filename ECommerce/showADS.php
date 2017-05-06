<!DOCTYPE html>
<html lang="en">
<head>
  <title>ADS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>	
</head>
<body>

<div class="container_fluid">
  <!--<h2>Striped Rows</h2>-->
  
    <form action ="#" method="post">
  <table class='table table-striped'>
    <thead>
      <tr>
        <th>adsId</th>
        <th>typeId</th>
        <th>adsPicture</th>
        <th>adsUrl</th>
        <th>adsStartDate</th>
        <th>adsEndDate</th>
        <th>adsApproveState</th>
		<th>userId</th>
      </tr>
    </thead>
    <tbody>
<?php

require 'Admin.php' ;

$admin=new Admin ;

$result= $admin->showAds();
/*  
 * SELECT `adsId`, `typeId`, `adsPicture`, `adsUrl`,
 `adsStartDate`, `adsEndDate`, `adsApproveState`, `userId` FROM `ads` WHERE 1
 */
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo " <tr>
        <td><input type='radio' name='adsId' style='width:30px;height:30px;' value='".$row['adsId']."'></td>
        <td>".$row['typeId']."</td>
        <td> <img src='".$row['adsPicture']."</td>
        <td>".$row['adsUrl']."</td>
        <td>".$row['adsStartDate']."</td>
        <td>".$row['adsEndDate']."</td>
        <td>".$row['adsApproveState']."</td>
        <td>".$row['userId']."</td>
      </tr>";
    }
} else {
    echo "0 results";
}

?>
</tbody>
  </table>
    <center><input class="btn" style="background-color:#4347d2;color:#fff;" type="submit" name="submit"/></center>
</form>
</div>
</body>
</html>
