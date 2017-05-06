<!DOCTYPE HTML>
<html>
	<head>
		<title>My Play a Entertainment Category Flat Bootstrap Responsive Website Template | Shows :: w3layouts</title>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<meta name='keywords' content='My Play Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design' />
		<script type='application/x-javascript'>
			addEventListener('load', function() {
				setTimeout(hideURLbar, 0);
			}, false);
			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- bootstrap -->
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
		<style>
			#btn {
				background-color: #86edf6;
			}
			#btn:hover {
				background-color: red;
				color: #21DEEF;
			}
		</style>
		<?php
		require_once('notification_sources.php');
		?>
	</head>
	<body>
		<?php
			require_once('./User.php');
      require_once('./notification_function.php');
    	require_once('./startSession.php');
	    require_once('./signin_signup.php');
	    require_once('./header.php');
			require_once('./subscribtion.php');
		?>

		<div class='col-sm-3 col-md-2 sidebar'>
			<div class='top-navigation'>
				<div class='t-menu'>
					MENU
				</div>
				<div class='t-img'>
					<img src='images/lines.png' alt='' />
				</div>
				<div class='clearfix'></div>
			</div>
			<div class='drop-navigation drop-navigation'>
				<ul class='nav nav-sidebar'>
					<li><a href='./index.php' class='home-icon'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Home</a></li>
					<?php
						if(!empty($_SESSION['username'])){
						echo "<li  class='active'><a href='myChannel.php' class='user-icon'><span class='glyphicon glyphicon-home glyphicon-blackboard' aria-hidden='true'></span>My Channel</a></li>
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
						$('li a.menu1').click(function() {
							$('ul.cl-effect-2').slideToggle(300, function() {
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
						$('li a.menu').click(function() {
							$('ul.cl-effect-1').slideToggle(300, function() {
								// Animation complete.
							});
						});
					</script>
					<!--
					<li><a href='movies.html' class='song-icon'><span class='glyphicon glyphicon-music' aria-hidden='true'></span>Songs</a></li>
					<li><a href='news.html' class='news-icon'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span>News</a></li>
					-->
				</ul>
				<!-- script-for-menu -->
				<script>
					$('.top-navigation').click(function() {
						$('.drop-navigation').slideToggle(300, function() {
							// Animation complete.
						});
					});
				</script>
				<div class='side-bottom'>
					<div class='side-bottom-icons'>
						<ul class='nav2'>
							<li>
								<a href='#' class='facebook'> </a>
							</li>
							<li>
								<a href='#' class='facebook twitter'> </a>
							</li>
							<li>
								<a href='#' class='facebook chrome'> </a>
							</li>
							<li>
								<a href='#' class='facebook dribbble'> </a>
							</li>
						</ul>
					</div>
					<div class='copyright'>
						<p>
							Developed By <b><a href="https://www.facebook.com/abdelrahman.rashed.370">Abdelrahman Rashed</a></b>
<a href="https://www.facebook.com/profile.php?id=100011416125469&fref=ts">Mahmoud Ahmed</a>
<u><a href="https://www.facebook.com/omar.tammam.9?fref=ts">Omar Tammam</a></u></a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main'>
			<div class='show-top-grids' style='min-height:500px;'>
				<div class='col-sm-12 show-grid-left main-grids'>
					<div class='recommended'>
						<div class='recommended-grids english-grid'>
							<!-- Channel Header Here !-->
							<?php
							if(!empty($_GET['channel'])){
							$user = new User();
							$guest = new Guest();
							$validator = new Validation();
							if($validator->validateLength(cleanSQL($_GET['channel']), 6, "Channel")){
								if($guest->getChannelId(cleanSQL($_GET['channel'])) != -1){
									$channelId = $guest->getChannelId(cleanSQL($_GET['channel']));
									$result = $guest -> getChannelInfo($channelId);
									$channelRow = $result -> fetch_assoc();
									$channelName = $channelRow['channelName'];
									$channelFollowers = $channelRow['followerNumber'];
									$channelUserId = $channelRow['userId'];
									$channelImage = $channelRow['channelImg'];
									echo "
										<div class='recommended-grids english-grid'>
										<!-- Channel Header Here !-->
										<div style='width:100%;height:300px;margin-bottom:20px;background-image:url(./images/bg.jpg);background-size:cover;'>
										<div style='position: absolute;top:200px;background-color:#fff;opacity:0.8;width:100%;height:110px;'>
								  		<span id='btn' style='background-color:##86edf6;color:#000;border-radius:5%;border:1px solid #000;float:left;margin-left:30px;margin-top:25px;opacity:1;font-size:36px;padding:10px 40px;'>$channelName</span>
								  		<span id='btn' style='background-color:red;color:#fff;float:left;border-radius:5%;border:1px solid #000;margin-left:30px;margin-top:25px;opacity:1;font-size:36px;padding:10px 40px;'>$channelFollowers subscriber</span>
								  		";
								  	if(!empty($_SESSION['userId'])){
										if($_SESSION['userId'] != $channelUserId){
											$getter = cleanSQL($_GET['channel']);
											echo "<form action = '$pageUrl' method = 'post'>";
											echo "<input type = 'hidden' name = 'channelId' value = '$getter'>";
											if($user->getSubscribtionState($channelId)){
												echo "<button name = 'unsubscribe' class='btn btn-info' style='color:#fff;float:right;border-radius:10%;border:1px solid #000;margin-right:30px;margin-top:25px;opacity:1;font-size:24px;padding:10px 20px;'>unsubscribe</button>";
											} else {
												echo "<button name = 'subscribe' class='btn btn-info' style='color:#fff;float:right;border-radius:10%;border:1px solid #000;margin-right:30px;margin-top:25px;opacity:1;font-size:24px;padding:10px 20px;'>subscribe</button>";
											}
											echo "</form>";
										}
								  	}
								  	echo "</div></div>";
								  	echo "<div class='clearfix'> </div></div>";
								  	// echo videos here
									$result = $guest->getVideosByChannelId($channelId);
									while ($videoRow = $result->fetch_assoc()){
										$videoId = $videoRow['videoId'];
										$videoTitle = $videoRow['videoTitle'];
										$videoLink = $videoRow['videoLink'];
										$videoViews = $videoRow['views'];
										$videoUploader = $videoRow['username'];
										echo "<!--   video  -->
											<div class='col-md-2 resent-grid recommended-grid show-video-grid'>
											<div class='resent-grid-img recommended-grid-img'>
											<a href='viewVideo.php?videoLink=$videoLink'><img src='./images/$videoLink.jpg' alt='$videoLink.jpg' /></a>
											</div>
											<div class='resent-grid-info recommended-grid-info'>
											<h5><a href='viewVideo.php?videoLink=$videoLink' class='title'>$videoTitle</a></h5>
											<p class='author'><a href='viewChannel.php?channel=$videoUploader' class='author'>$videoUploader</a></p>
											<p class='views'>$videoViews views</p>
											</div>
											</div>";
									}
								}
								else {
								notify("Error","Channel Not Found");
								}
							}
							else {
								notify("Error",$validator->getLastErrorMessage());
							}
						}
						else {
							notify("Error","No Channel Specified");
							}
						?>
							<div class='clearfix'> </div>
							</div>
						</div>
					</div>
					<div class='clearfix'></div>
			</div>
				<?php
					require_once('footer.php');
 				?>
				<!-- //footer -->
		</div>
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

			<script src='js/bootstrap.min.js'></script>
	</body>
</html>
