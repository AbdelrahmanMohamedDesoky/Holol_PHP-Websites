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
  
    <form action ="./AdminAction.php" method="post">
  <table class='table table-striped'>
    <thead>
      <tr>
        <th>adsId</th>
        <th>typeId</th>
        <th>adsPicture</th>
        <th>adsUrl</th>
        <th>adsStartDate</th>
        <th>adsEndDate</th>
      </tr>
    </thead>
    <tbody>
<?php

require '../Admin.php' ;

$admin=new Admin ;

$result= $admin->showUnapprovedAds();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$typeId = $row['typeId'];
    	$adsPicture = $row['adsPicture'];
    	$adsUrl = $row['adsUrl'];
    	$adsStartDate = $row['adsStartDate'];
    	$adsEndDate = $row['adsEndDate'];
    	$adsApproveState = $row['adsApproveState'];
        echo " <tr>
        <td><input type='radio' name='adsId' style='width:30px;height:30px;' value='".$row['adsId']."'></td>
        <td>$typeId </td>
        <td><img src = '../images/$adsPicture.jpg'</td>
        <td>$adsUrl</td>
        <td>$adsStartDate</td>
        <td>$adsEndDate</td>
      </tr>";
    }
} else {
    echo "0 results";
}

?>
</tbody>
  </table>
    <center><input class="btn" style="background-color:#4347d2;color:#fff;" type="submit" name="aproveADS" value='Approve Ads'/></center>
</form>
</div>
</body>
</html>
