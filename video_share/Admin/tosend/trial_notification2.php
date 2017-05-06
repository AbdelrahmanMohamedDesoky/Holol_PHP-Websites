<html>
<head>

<?php 

include 'notification_sources.php';

?>
  
</head>
<body>
	<!-- GLOBAL SCRIPTS -->
 <?php 
 require 'notification_function.php';
 ?>
	<div style="width:100%;height:500px;background-color:red;"></div>
		<div style="width:100%;height:500px;background-color:green;"></div>
	<!--?php echo "-->
	<?php
	$title="successfully";
	$text=" insert new user";
	
	notify ($title,$text);
  
  
  
	?>
	<!--";?>-->
     <!--END PAGE LEVEL SCRIPTS -->
</body>
</html>