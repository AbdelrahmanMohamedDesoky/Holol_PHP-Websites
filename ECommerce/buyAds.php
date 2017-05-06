<?php
session_start();
require_once('companyLoginCheck.php');
?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <body style="background-color: #CC3333;">
<center>
<form action = 'confirmAds.php' method = 'post' enctype="multipart/form-data"> 
  <div class="form-group">
    <label>Ads Url :</label>
    <input style="width:30%;" type="text" class="form-control input-lg"  id="email" name = 'adsUrl' placeholder='Ads Url Here'>
  </div>
  <div class="form-group">
        <label class="control-label">A file upload button without icon</label>
        <input type="file" name="img"  class="filestyle" data-icon="false">
    </div>
	
	<input type ='hidden' name = 'adsId' value = '<?php echo cleanSQLNationalId($_GET['id']);?>'>
    <input type = 'submit' class="btn-primary btn-lg" name = 'confirmAds' value = 'Confirm Ad'>
  
</form>

</center>
</body>
</html>
