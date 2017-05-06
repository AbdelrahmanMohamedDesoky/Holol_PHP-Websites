<?php
require_once("./startSession.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>My Play a Entertainment Category Flat Bootstrap Responsive Website Template | Home :: w3layouts</title>
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='keywords' content='My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design' />
<script type='application/x-javascript'> addEventListener('load', function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap -->
<?php
require_once('validation_css_sources.php');
?>
<link href='css/bootstrap.min.css' rel='stylesheet' type='text/css' media='all' />

<!-- //bootstrap -->
<link href='css/dashboard.css' rel='stylesheet'>
<!-- Custom Theme files -->
<link href='css/style.css' rel='stylesheet' type='text/css' media='all' />
<script src='js/jquery-1.11.1.min.js'></script>
<!--start-smoth-scrolling-->
<!-- fonts -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
<!-- //fonts -->
<?php
require_once('notification_sources.php');
?>
</head>
  <body>
       <?php
       	require_once('./notification_function.php');
    	require_once('./startSession.php');
	    require_once('./signin_signup.php');
	    require_once('./header.php');
	   ?>

        <div class='col-sm-3 col-md-2 sidebar'>
			<div class='top-navigation'>
				<div class='t-menu'>MENU</div>
				<div class='t-img'>
					<img src='images/lines.png' alt='' />
				</div>
				<div class='clearfix'> </div>
			</div>
				<div class='drop-navigation drop-navigation'>
				  <ul class='nav nav-sidebar'>
					<li class='active'><a href='./index.php' class='home-icon'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Home</a></li>
					<?php
						if(!empty($_SESSION['username'])){
						echo "<li><a href='myChannel.php' class='user-icon'><span class='glyphicon glyphicon-home glyphicon-blackboard' aria-hidden='true'></span>My Channel</a></li>
							  <li><a href='mySubscribtion.php' class='sub-icon'><span class='glyphicon glyphicon-home glyphicon-hourglass' aria-hidden='true'></span>My Subscription </a></li>";
						}
					?>
						<li><a href='#' class='menu1'><span class='glyphicon glyphicon-film' aria-hidden='true'></span>Categories<span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span></a></li>
						<ul class='cl-effect-2'>
							<?php
							require_once('./getCategories.php');
							?>
						</ul>
						<!-- script-for-menu -->
						<script>
							$( 'li a.menu1' ).click(function() {
							$( 'ul.cl-effect-2' ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
						<!--
					<li><a href='#' class='menu'><span class='glyphicon glyphicon-film glyphicon-king' aria-hidden='true'></span>Sports<span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span></a></li>
						<ul class='cl-effect-1'>
							<li><a href='sports.html'>Football</a></li>
							<li><a href='sports.html'>Cricket</a></li>
							<li><a href='sports.html'>Tennis</a></li>
							<li><a href='sports.html'>Shattil</a></li>
						</ul>
						<!-- script-for-menu -->
						<script>
							$( 'li a.menu' ).click(function() {
							$( 'ul.cl-effect-1' ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
						<!--
					<li><a href='movies.html' class='song-icon'><span class='glyphicon glyphicon-music' aria-hidden='true'></span>Songs</a></li>
					<li><a href='news.html' class='news-icon'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span>News</a></li>
				 --> </ul>
				  <!-- script-for-menu -->
						<script>
							$( '.top-navigation' ).click(function() {
							$( '.drop-navigation' ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<div class='side-bottom'>
						<div class='side-bottom-icons'>
							<ul class='nav2'>
								<li><a href='#' class='facebook'> </a></li>
								<li><a href='#' class='facebook twitter'> </a></li>
								<li><a href='#' class='facebook chrome'> </a></li>
								<li><a href='#' class='facebook dribbble'> </a></li>
							</ul>
						</div>
						<div class='copyright'>
							<p>Developed By <b><a href="https://www.facebook.com/abdelrahman.rashed.370">Abdelrahman Rashed</a></b>
<a href="https://www.facebook.com/profile.php?id=100011416125469&fref=ts">Mahmoud Ahmed</a>
<u><a href="https://www.facebook.com/omar.tammam.9?fref=ts">Omar Tammam</a></u></a></p>
						</div>
					</div>
				</div>
        </div>
        <div class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main' style='padding-bottom:0px;'>
			<div class='main-grids' style='padding-bottom:0px;padding-left:0px;'>
				<div class='top-grids' style='padding-bottom:0px;padding-left:10px;'>
					<div class='recommended-info'>
						<h3>Recent Videos</h3>
					<!-- Echo Video HERE !-->
					<?php
					$result = $guest->getRecentVideos();
					while ($videoRow = $result->fetch_assoc()){
						$videoId = $videoRow['videoId'];
						$videoTitle = $videoRow['videoTitle'];
						$videoLink = $videoRow['videoLink'];
						$videoViews = $videoRow['views'];
						$videoUploader = $videoRow['username'];
					echo "<div class='col-md-4 resent-grid recommended-grid slider-top-grids' style='margin-top:10px;'>
							<div class='resent-grid-img recommended-grid-img'>
							<a href='./viewVideo.php?videoLink=$videoLink'><img src='./images/$videoLink.jpg' style='max-width:360px;max-height:260px;' alt='' /></a>
							</div>
							<div class='resent-grid-info recommended-grid-info'>
							<h3><a href='./viewVideo.php?videoLink=$videoLink' class='title title-info'>$videoTitle</a></h3>
							<ul>
								<li><p class='author author-info'><a href='./viewChannel.php?channel=$videoUploader' class='author'>$videoUploader</a></p></li>
								<li class='right-list'><p class='views views-info'>$videoViews views</p></li>
							</ul>
						</div>
					</div>";
					}
					?>
				    <!-- End Video Here !-->


				</div>
            </div>

				<div class='clearfix' style='min-height:500px;'> </div>
				<div style="padding-top:15px;"> </div>
			<?php include 'footer.php' ; ?>
			<div class='clearfix'> </div>
	<div class='drop-menu'>
		<ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu4'>
		  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Regular link</a></li>
		  <li role='presentation' class='disabled'><a role='menuitem' tabindex='-1' href='#'>Disabled link</a></li>
		  <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Another link</a></li>
		</ul>
	</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='js/bootstrap.min.js'></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<?php
		require_once('validation_js_sources.php');

		?>

  </body>
</html>
