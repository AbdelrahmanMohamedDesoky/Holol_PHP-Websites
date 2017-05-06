<!DOCTYPE HTML>
<html>
	<head>
		<title>My Play a Entertainment Category Flat Bootstrap Responsive Website Template | single :: w3layouts</title>
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
		<?php
		require_once ('notification_sources.php');
		?>
	</head>
	<body>
		<div id="fb-root"></div>
		<script>
			( function(d, s, id) {
					var js,
					    fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id))
						return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
		</script>
		<?php
		require_once ('./notification_function.php');
		require_once ('./startSession.php');
		require_once ('./signin_signup.php');
		require_once ('./header.php');
		require_once ('./comments.php');
		?>
		<div class='row' style='margin:0px;padding:0px;'>
		<div class="col-sm-3 col-md-2 sidebar">
			<div class="top-navigation">
				<div class="t-menu">
					MENU
				</div>
				<div class="t-img">
					<img src="images/lines.png" alt="" />
				</div>
				<div class="clearfix"></div>
			</div>
			<div class='drop-navigation drop-navigation'>
				<ul class='nav nav-sidebar'>
					<li class='active'>
						<a href='./index.php' class='home-icon'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Home</a>
					</li>
					<?php
					if (!empty($_SESSION['username'])) {
						echo "<li><a href='myChannel.php' class='user-icon'><span class='glyphicon glyphicon-home glyphicon-blackboard' aria-hidden='true'></span>My Channel</a></li>
							    <li><a href='mySubscribtion.php' class='sub-icon'><span class='glyphicon glyphicon-home glyphicon-hourglass' aria-hidden='true'></span>My Subscription </a></li>";
					}
					?>
					<li>
						<a href='#' class='menu1'><span class='glyphicon glyphicon-film' aria-hidden='true'></span>Categories<span class='glyphicon glyphicon-menu-down' aria-hidden='true'></span></a>
					</li>
					<ul class='cl-effect-2'>
						<?php
						require_once ('./getCategories.php');
						?>
					</ul>
						<!-- script-for-menu -->
						<script>
							$("li a.menu1").click(function() {
								$("ul.cl-effect-2").slideToggle(300, function() {
									// Animation complete.
								});
							});
						</script>
						<!-- script-for-menu -->
						<script>
							$("li a.menu").click(function() {
								$("ul.cl-effect-1").slideToggle(300, function() {
									// Animation complete.
								});
							});
						</script>
					</ul>
					<!-- script-for-menu -->
					<script>
						$(".top-navigation").click(function() {
							$(".drop-navigation").slideToggle(300, function() {
								// Animation complete.
							});
						});
					</script>
					<div class="side-bottom">
						<div class="side-bottom-icons">
							<ul class="nav2">
								<li>
									<a href="#" class="facebook"> </a>
								</li>
								<li>
									<a href="#" class="facebook twitter"> </a>
								</li>
								<li>
									<a href="#" class="facebook chrome"> </a>
								</li>
								<li>
									<a href="#" class="facebook dribbble"> </a>
								</li>
							</ul>
						</div>
						<div class="copyright">
							<p>
								Developed By <b><a href="https://www.facebook.com/abdelrahman.rashed.370">Abdelrahman Rashed</a></b>
<a href="https://www.facebook.com/profile.php?id=100011416125469&fref=ts">Mahmoud Ahmed</a>
<u><a href="https://www.facebook.com/omar.tammam.9?fref=ts">Omar Tammam</a></u>
							</p>
						</div>
					</div>
			</div>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-2 main">
			<div class="show-top-grids">
				<?php
				$guest = new Guest();
				if (!empty(cleanSQL($_GET['videoLink']))) {
					$videoLink = (cleanSQL($_GET['videoLink'] == NULL)) ? "" : cleanSQL($_GET['videoLink']);
					$result = $guest -> viewVideo($videoLink);
					$videoRow = $result -> fetch_assoc();
					$videoId = $videoRow['videoId'];
					$videoTitle = $videoRow['videoTitle'];
					$videoLink = $videoRow['videoLink'];
					$videoViews = $videoRow['views'];
					$videoUploader = $videoRow['username'];
					$videoDate = $videoRow['videoDate'];
					$fullUrl = full_url( $_SERVER );
					echo "<div class='single-left' style='margin:10px;>
					<div class='song'>
					<div class='song-info'>
					<h3>$videoTitle</h3>
					</div>
					<div class='video-grid'>
					<video width='640' height='360' id='the-video' preload='' controls='controls'>
					<source src='./videos/$videoLink.mp4' type='video/mp4'>
					I'm sorry; your browser doesn't support HTML5 video in WebM with VP8 or MP4 with H.264.
					</video>
					</div>
					</div>
					<div class='song-grid-right'>
					<div class='share'>
					<h5>Share this</h5>
					<ul>
					<li class='view'>$videoViews Views</li>
					<li><div class='fb-share-button' data-href='$fullUrl' data-layout='button_count' data-size='small' data-mobile-iframe='true'><a class='fb-xfbml-parse-ignore' target='_blank' href='https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse'>Share</a></div></li>
						</ul>
						</div>
						</div>
						<div class='clearfix'> </div>
						<div class='published'>
						<script src='jquery-1.11.1.min.js'></script>
						<script>
						$(document).ready(function () {
							size_li = $('#myList li').size();
							x=1;$('#myList li:lt('+x+')').show();$('#loadMore').click(function () {x= (x+1 <= size_li) ? x+1 : size_li;$('#myList li:lt('+x+')').show();});
							$('#showLess').click(function () {x=(x-1<0) ? 1 : x-1;$('#myList li').not(':lt('+x+')').hide();});});
							</script>
						<div class='load_more'>
						<ul id='myList'>
						<li>
						<h4>Published on $videoDate</h4>
						<a href = './viewChannel.php?channel=$videoUploader'>$videoUploader</a>
						</li>
						</ul>
						</div>
						</div>";
						?>
						<!-- Comments Goes Here !-->
						<div class='all-comments'>
						<div class='all-comments-info'>
						<?php
						if(!empty($_SESSION['username'])){
							echo "
													<div class='box'>
													<form action = '$pageUrl' method = 'POST'>
													<input type='hidden' name = 'videoId' value = '$videoId'>
													<textarea placeholder='Message' name = 'commentContent' required='true'></textarea>
													<input type='submit' name = 'postComment' value='Post Comment'>
													<!-- echo a hidden input type for video id here ! !-->
													<div class='clearfix'> </div>
													</form>
													</div>";
						}
						$result = $guest->getCommentsByVideoLink($videoLink);
						while($commentRow = $result->fetch_assoc()){
							$commentContent = $commentRow['commentContent'];
							$commenterId = $commentRow['userId'];
							$commentUser = $guest->getUserName($commenterId);
							$commentId = $commentRow['commentsId'];
							echo "
							<div class='media'>
								<h5>$commentUser</h5>
								<div class='media-left'>
									<a href='./viewChannel.php?channel=$commentUser'><img style ='width: 65px;height:65px;display: block;border-radius:50%;' src='images/$commentUser.jpg' ></a>
								</div>
								<div class='media-body'>
									<p>$commentContent</p>
								</div>
								";
								if(!empty($_SESSION['username'])){
									if($_SESSION['userId'] == $commenterId){
										echo "
										<form action = '$pageUrl' method = 'POST'>
										<input type = 'hidden' name = 'commentId' value ='$commentId'>
										<input type='submit' name='deleteComment' value='delete'>
										</form>";
									}
								}
								echo "
							</div>";
						}
					 echo "</div>";
				 }
					 ?>
						</div>
					</div>
				</div>
			</div>"
			</div>
		

		<div class='clearfix' style='min-height:500px;'></div>
		<?php
			include 'footer.php';
 ?>
		<div class='clearfix'></div>
		<div class='drop-menu'>
			<ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu4'>
				<li role='presentation'>
					<a role='menuitem' tabindex='-1' href='#'>Regular link</a>
				</li>
				<li role='presentation' class='disabled'>
					<a role='menuitem' tabindex='-1' href='#'>Disabled link</a>
				</li>
				<li role='presentation'>
					<a role='menuitem' tabindex='-1' href='#'>Another link</a>
				</li>
			</ul>
		</div>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
	</body>

</html>
