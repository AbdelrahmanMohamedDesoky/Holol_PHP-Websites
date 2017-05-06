<?php
require_once("./loginCheck.php");
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

		require('validation_css_sources.php');
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
  <style>
    /* USER PROFILE PAGE */
 .card {
    margin-top: 20px;
    padding: 30px;
    background-color: rgba(214, 224, 226, 0.2);
    -webkit-border-top-left-radius:5px;
    -moz-border-top-left-radius:5px;
    border-top-left-radius:5px;
    -webkit-border-top-right-radius:5px;
    -moz-border-top-right-radius:5px;
    border-top-right-radius:5px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.card.hovercard {
    position: relative;
    padding-top: 0;
    overflow: hidden;
    text-align: center;
    background-color: #fff;
    background-color: rgba(255, 255, 255, 1);
}
.card.hovercard .card-background {
    height: 130px;
}
.card-background img {
    -webkit-filter: blur(25px);
    -moz-filter: blur(25px);
    -o-filter: blur(25px);
    -ms-filter: blur(25px);
    filter: blur(25px);
    margin-left: -100px;
    margin-top: -200px;
    min-width: 130%;
}
.card.hovercard .useravatar {
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
}
.card.hovercard .useravatar img {
    width: 100px;
    height: 100px;
    max-width: 100px;
    max-height: 100px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    border: 5px solid rgba(255, 255, 255, 0.5);
}
.card.hovercard .card-info {
    position: absolute;
    bottom: 14px;
    left: 0;
    right: 0;
}
.card.hovercard .card-info .card-title {
    padding:0 5px;
    font-size: 20px;
    line-height: 1;
    color: #262626;
    background-color: rgba(255, 255, 255, 0.1);
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.card.hovercard .card-info {
    overflow: hidden;
    font-size: 12px;
    line-height: 20px;
    color: #737373;
    text-overflow: ellipsis;
}
.card.hovercard .bottom {
    padding: 0 20px;
    margin-bottom: 17px;
}
.btn-pref .btn {
    -webkit-border-radius:0 !important;
}



    </style>
</head>
  <body style="padding-bottom:0px;">
       <?php
      require_once('./notification_function.php');
    	require_once('./startSession.php');
	    require_once('./signin_signup.php');
	    require_once('./header.php');
			require_once('./edit-profile.php');
			$username = $_SESSION['username'];
	   ?>
	      <script>
            $(document).ready(function() {
$(".btn-pref .btn").click(function () {
    $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
    // $(".tab").addClass("active"); // instead of this do the below
    $(this).removeClass("btn-default").addClass("btn-primary");
});
});
            </script>
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
					<li><a href='./index.php' class='home-icon'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Home</a></li>
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
							<p><b><a href="https://www.facebook.com/abdelrahman.rashed.370">Abdelrahman Rashed</a></b>
<a href="https://www.facebook.com/profile.php?id=100011416125469&fref=ts">Mahmoud Ahmed</a>
<u><a href="https://www.facebook.com/omar.tammam.9?fref=ts">Omar Tammam</a></u></p>
						</div>
					</div>
				</div>
        </div>
       <div class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main' style="padding:0px;">
			<div class='main-grids' style="padding:0px;">
				<div class='top-grids' style=""></div>
				        <div class="col-lg-12 col-sm-12" style="margin-top:50px;">
    <div class="card hovercard">
        <div class="card-background">
            <img class="card-bkimg" alt="" src="images/<?php echo "$username.jpg".'?'. uniqid();?>">
            <!-- http://lorempixel.com/850/280/people/9/ -->
        </div>
        <div class="useravatar">
            <img alt="" src="images/<?php echo "$username.jpg".'?'. uniqid();?>">
        </div>
        <div class="card-info"> <span class="card-title" style='color:white';><?php echo $username ?></span>

        </div>
    </div>
    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                <div class="hidden-xs">Channel Profile</div>
            </button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
                <div class="hidden-xs">User Profile</div>
            </button>
        </div>


    </div>

        <div class="well">
      <div class="tab-content">
        <div class="tab-pane fade in active" id="tab1">
            <form action="./user-profile.php" method="post">
                 <div class="form-group">
                  <label for="inputdefault">Channel name</label>
                  <input class="form-control" id="inputdefault" type="text" name="channelName" placeholder = 'Channel Name'>
				  <br>
                <input type="submit" name="editChannelName" class="btn btn-primary" value = "UpdateName">
				</div>
            </form>
            <form action="./user-profile.php" method="post" enctype="multipart/form-data">
                  <div class="btn btn-default image-preview-input">
                       <label>Channl Image</label>
                        <input type="file" accept="image/png, image/jpeg, image/gif" name="img"/>
						 <br>
						 <input type="submit" name="editChannelImage" class="btn btn-info" value="Update Channel Image">
                    </div>
					<br>
					<br>
            </form>
            <form action="./user-profile.php" method="post">
                 <label for="usr">Select Video</label>
                <select name = 'videoId'>
									<?php
										$result = $user->getVideosId();
										if($result !== false){
											while($videoRow = $result->fetch_assoc()){
												$videoId = $videoRow['videoId'];
												$videoTitle = $videoRow['videoTitle'];
												echo "<option value = '$videoId'>$videoTitle</option>";
											}
										} else {
											echo "<option value = '-1' >No Videos</option>";
										}
									?>
                </select>
				<br>
				<br>
                <input type="submit" name="deleteVideo" class="btn btn-info" value="Delete Video">
            </form>
            </div>


        				<div class="tab-pane fade in" id="tab2">
 									<!-- Email Change Form !-->
            		<form action="./user-profile.php" method="POST">
               	<div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email"> <br>
								<input type="submit" name="editEmail" class="btn btn-info" value="Update Email">
                </div>
								</form>

                <br>
                <br>
									 <!-- Password Change Form !-->
									<form action="./user-profile.php" method="POST">
                  <div class="form-group">
                   <label for="pwd">Password:</label>
                   <input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password">
                    </div>
                 <div class="form-group">
                   <label for="pwd">Confirm Password:</label>
                   <input type="password" class="form-control" name="password_confirm" id="pwd" placeholder="Enter confirm password">
                    </div>
									<input type="submit" name="editPassword" class="btn btn-info" value="Change Password">
									</form>
									<br>
                 	<br>
								 	<br>
								 <!-- User Image Form !-->
								 <form action="./user-profile.php" method="POST" enctype="multipart/form-data">
                 <label for="usr">User Image</label>
                	<input class="form-control-static" type="file" name="img">
                	<input type="submit" name="editProfileImg" class="btn btn-info" value="Change Profile Picture">
								</form>
        </div>

      </div>
    </div>

    </div>

				<div class='clearfix' style='min-height:500px;'> </div>

			<div class='clearfix'></div>
			<?php include 'footer.php' ; ?>

	</div>
	</div>
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
