<nav class='navbar navbar-inverse navbar-fixed-top'>
      <div class='container-fluid'>
        <div class='navbar-header'>
          <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='navbar-brand' href='../index.php'><h1><img src='images/logo.png' height="53px" width="153px" /></h1></a>
        </div>
        
		<div id='navbar' class='navbar-collapse collapse'>
			<div class='top-search' style="">
				
			</div>
			<div class='header-top-right'>
				<!-- upload button !-->
				<?php
				$pageUrl = $_SERVER['REQUEST_URI'];
				if(!empty($_SESSION['username'])){
					echo "<div class='file'>
						<a href='../upload.php'>Upload</a>
						</div>";
          		$username = $_SESSION['username'];
		  		if($_SESSION['userType'] == 1){
		  			echo "<div class='file'>
						<a href='./index.php' style='margin:5px'>Admin</a>
						</div>";
		  		}
					echo "<div class='file'>
						<a href='./myChannel.php' style='margin:5px'>$username</a>
						</div>";
          echo "<div class='file'>
              <a href='./logout.php'>Logout!</a>
              </div>";
				} else {
					echo "                <!-- sign up -->
				<div class='signin'>
					<a href='#small-dialog2' class='play-icon popup-with-zoom-anim'>Sign Up</a>
					<!-- pop-up-box -->
									<script type='text/javascript' src='js/modernizr.custom.min.js'></script>
									<link href='css/popuo-box.css' rel='stylesheet' type='text/css' media='all' />
									<script src='js/jquery.magnific-popup.js' type='text/javascript'></script>
									<!--//pop-up-box -->
								<div id='small-dialog2' class='mfp-hide'>
									<div class=''>
									<h3 style='color:#21DEEF;'>Create Account</h3>
										<div class='box' style=''>
											<form action='$pageUrl' method = 'POST' class='form-horizontal' id='popup-validation'>
                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>UserName</label>

                                            <div class='col-lg-8'>
                                                <input type='text' id='username' name='username' class='validate[required],minSize[6]] form-control col-lg-6' />
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>E-mail</label>

                                            <div class='col-lg-8'>
                                                <input type='email' id='email' name='email2' class='validate[required,custom[email]],minSize[6]] form-control'  class='form-control col-lg-6' />
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>Password</label>

                                            <div class='col-lg-8'>
                                                <input type='password' id='password' name='password' class='validate[required],minSize[6]] form-control col-lg-6' />
                                            </div>
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>Confirm Password</label>

                                            <div class='col-lg-8'>
                                                <input type='password' id='confirm_password' name='confirm_password' class='validate[required,equals[password]] form-control col-lg-6' />
                                            </div>
                                        </div>
										<div class='form-actions' style='text-align:center;'>
                                           <div style='margin:0px auto;width:100px;'> <input type='submit' name = 'signup' value='sign up' class='btn btn-primary btn-lg' /></div>
                                        </div>
										</form>
										</div>
										</div>
										<div class='clearfix'> </div>
									</div>
									<script>
											$(document).ready(function() {
											$('.popup-with-zoom-anim').magnificPopup({
												type: 'inline',
												fixedContentPos: false,
												fixedBgPos: true,
												overflowY: 'auto',
												closeBtnInside: true,
												preloader: false,
												midClick: true,
												removalDelay: 300,
												mainClass: 'my-mfp-zoom-in'
											});

											});
									</script>
				</div>
				<!-- sign in -->
				<div class='signin'>
					<a href='#small-dialog' class='play-icon popup-with-zoom-anim'>Sign In</a>
					<div id='small-dialog' class='mfp-hide'>
						<h3 style='color:#21DEEF;'>Login</h3>

						<div class=''>
							<div class='box' style=''>
											<form action='$pageUrl' method = 'POST' class='form-horizontal' id='inline-validate'>
                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>Username</label>

                                            <div class='col-lg-8'>
                                                <input type='text' id='username' name='username' class='validate[required],minSize[6]] form-control col-lg-6' />
                                            </div>
                                        </div>

                                        <div class='form-group'>
                                            <label class='control-label col-lg-4'>Password</label>

                                            <div class='col-lg-5'>
                                                <input type='password' id='password' name='password' class='validate[required],minSize[6]] form-control col-lg-6' />
                                            </div>
                                        </div>

										<div class='form-actions' style='text-align:center;'>
                                           <div style='margin:0px auto;width:100px;'> <input type='submit' value='SIGN IN' name = 'signin' class='btn btn-primary btn-lg' /></div>
                                        </div>
										</form>
										</div>";
				}
				?>
			</div>
        </div>
		<div class='clearfix'> </div>
      </div>
    </nav>
  <!-- GLOBAL SCRIPTS -->

    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->

     