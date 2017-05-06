<?php
require_once ('./loginCheck.php');
require_once ('./startSession.php');
require_once ('./User.php');
require_once ('./Validation.php');
$user = new User();
$validator = new Validation();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>My Play a Entertainment Category Flat Bootstrap Responsive Website Template | Upload :: w3layouts</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);
			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- bootstrap -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' media="all" />
		<!-- //bootstrap -->
		<link href="css/dashboard.css" rel="stylesheet">
		<!-- Custom Theme files -->
		<link href="css/style.css" rel='stylesheet' type='text/css' media="all" />
		<script src="js/jquery-1.11.1.min.js"></script>
		<!--start-smoth-scrolling-->
		<!-- fonts -->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
		<!-- //fonts -->
		    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="validation2/css/bootstrap.css" />
    <link rel="stylesheet" href="validation2/css/main.css" />
    <link rel="stylesheet" href="validation2/css/theme.css" />
    <link rel="stylesheet" href="validation2/css/MoneAdmin.css" />
    <link rel="stylesheet" href="validation2/css/validationEngine.jquery.css" />
		<?php
		require_once('notification_sources.php');
		?>
	</head>
	<body>
		<?php
		include_once ('./header.php');
		require_once('notification_function.php');
		if (isset($_POST['upload'])) {
			if ($validator -> validateBeforeUpload($_FILES, cleanSQL($_POST['videoTitle']), cleanSQLNumbers($_POST['categoryId']))) {
				if ($validator -> validateLength(cleanSQL($_POST['videoKeywords']), 1, "Video Keywords")) {
					$videoKeywords = cleanSQL($_POST['videoKeywords']);
				} else {
					$videoKeywords = "";
				}
				$videoTitle = cleanSQL($_POST['videoTitle']);
				$categoryId = cleanSQLNumbers($_POST['categoryId']);
				if ($user -> uploadVideo($_FILES,$_FILES,$videoTitle, $categoryId, $videoKeywords)) {
					notify("Success", $user -> getLastSuccessMessage());
				} else {
					notify("Error", $user -> getLastSuccessMessage());
				}
			} else {
				notify("Error", $validator -> getLastErrorMessage());
			}
		}
		?>
		<!-- upload -->
		<div class="upload">
			<!-- container -->
			<div class="container">
				<div class="upload-grids">
					<center>
						<div class="upload-right">
						 <form action = './upload.php' method = "POST" enctype="multipart/form-data" id="popup-validation">
   <div style="margin:40px;font-size:14px;">
   <div class="form-group row">
	<div class="col-sm-2" >
      <label for="VideoTitle">Video Title:</label>
	 </div>
	 <div class="col-sm-10" >
      <input type="text" name ='videoTitle' class="validate[required],minSize[6]] form-control" id="VideoTitle" placeholder="Enter Video Title">
	  </div>
    </div>

 <div class="form-group row">
 <div class="col-sm-2" >
      <label for="Keyword">Video  Keyword:</label>
	  </div>
	   <div class="col-sm-10" >
      <input type="text" name = 'videoKeywords' class="form-control" id="Keyword" placeholder="Enter Video Keyword">
	  </div>
    </div>
<div class="form-group row">
<div class="col-sm-2" >
  <label for="sel1">Video Category</label>
  </div>
   <div class="col-sm-10" >
  <select class="validate[required] form-control"  name = 'categoryId' id="sel1">

  <option value =''>select category..</option>
<?php
									$result = $user -> getCategories();
									while ($categoryRow = $result -> fetch_assoc()) {
										$categoryName = $categoryRow['categoryName'];
										$categoryId = $categoryRow['categoryId'];
										echo "<option value ='$categoryId'>$categoryName</option>";
									}
									?>
  </select>
  </div>
</div class="col-sm-9">
<div class="form-group row" >
<div class="col-sm-3" >
  <label for="file1">Video File</label>
  </div>
  <div class="col-sm-3" >
    <input type="file" id="file1" name = 'video' class="validate[required] form-control" value="Choose Video File ..">
	</div>
</div>
<div class="form-group row">
<div class="col-sm-3" >
  <label for="file2">Video Image/thumbnail :</label>
  </div>

  <div class="col-sm-3" >
    <input type="file" id="file2" name = 'img' class="validate[required] form-control" value="Choose Image File ..">
	</div>
</div>
<br>
<br>
<div class="form-group row"class="col-sm-12">
<button type="submit" name="upload" class="btn btn-default">Submit</button>
</div>
</div>
  </form>
</div>
					</center>
				</div>

			</div>
		</div>
		<!-- //container -->
		</div>
		<!-- //upload -->

		<!-- footer -->

				<?php
				require_once ('footer.php');
				?>

		<!-- //footer -->
		<div class="clearfix"></div>
		<div class="drop-menu">
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu4">
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Regular link</a>
				</li>
				<li role="presentation" class="disabled">
					<a role="menuitem" tabindex="-1" href="#">Disabled link</a>
				</li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Another link</a>
				</li>
			</ul>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->

		  <!-- GLOBAL SCRIPTS -->
    <script src="validation2/js/jquery-2.0.3.min.js"></script>

    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->

     <script src="validation2/js/jquery.validationEngine.js"></script>
    <script src="validation2/js/jquery.validationEngine-en.js"></script>
    <script src="validation2/js/jquery.validate.min.js"></script>
    <script src="validation2/js/validationInit.js"></script>
    <script>
        $(function () { formValidation(); });
        </script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
	</body>
</html>
