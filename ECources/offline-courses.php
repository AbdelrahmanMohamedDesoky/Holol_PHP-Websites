<?php
require("signup_signin.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- IE Combitability Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Mobile First Meta -->

        <title>Courses | Offline</title>

        <link rel="stylesheet" href="css/bootstrap.css"> <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/animate.css"> <!-- Animate.CSS File -->
        <link rel="stylesheet" type="text/css" href="slick/slick.css"/><!-- Slick.css Carousel -->
        <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"><!-- Slick.css Carousel -->
        <link rel="stylesheet" href="css/main.css"> <!-- my framework CSS File -->
        <link rel="stylesheet" href="css/style.css"> <!-- CSS File -->
        <link rel="stylesheet" href="css/media.css"> <!-- Media Query File -->
        <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div id="top-nav">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            if (isset($errorMessage)) {
                                echo "<li><a href='#' data-toggle='modal'>$errorMessage</a></li>";
                                $errorMessage = NULL;
                            }
                            if (isset($_SESSION['username'])) {
                                $username = $_SESSION['username'];
                                // check if logged in user is an admin or not [to be added] to show admin panel button /admin
                                if (isset($_SESSION['isAdmin'])) {
                                    echo '<li><a href="/admin">Admin Panel</a></li>';
                                }
                                echo '<li><a href="user-profile.php">' . "Welcome : $username" . '</a></li>';

                                echo '<li><a href="logout.php">Logout</a></li>';
                            } else {
                                echo '<li><a href="#" data-toggle="modal" data-target="#sign-in-modal">Sign In</a></li>';
                                echo '<li><a href="#" data-toggle="modal" data-target="#sign-up-modal">Sign Up</a></li>';
                            }
                            ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <div id="sign-in">
                        <div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action ="offline-courses.php" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Sign In</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group col-xs-12">
                                                <p><input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p><input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="basic-addon1" required></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary" name="sign-in" value="Sign In">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="sign-up">
                        <form action ="offline-courses.php" method="post" enctype="multipart/form-data">
                            <div class="modal fade" id="sign-up-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group col-xs-12">
                                                <p>First Name: <br/><input type="text" class="form-control" name="firstname" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p>Last Name: <br/><input type="text" class="form-control" name="lastname"aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p>User Name: <br/><input type="text" class="form-control" name="username" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p>Password: <br/><input type="password" class="form-control" name="password" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p>Confirm Password: <br/> <input type="password" class="form-control" name="password_confirm" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group col-xs-12">
                                                <p>E-mail: <br/> <input type="text" class="form-control" name="email" aria-describedby="basic-addon1" required></p>
                                            </div>
                                            <div class="input-group">
                                                <p>Profile Picture: <br/>
                                                    <input type="file" class="img" name="img" aria-describedby="basic-addon1" accept=".png,.jpeg,.jpg,.bmp,.gif" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-primary"  name="sign-up" value="Sign Up">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="bottom-nav">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">ECourses</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="index.php" class="act">Home</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="online-courses.php">Online Course</a></li>
                                    <li><a href="offline-courses.php">Offline Course</a></li>
                                </ul>
                            </li>
                            <?php
                            if (!isset($_SESSION)) {
                                session_start();
                            }
                            if (isset($_SESSION['username'])) {
                                echo "<li><a href='user-profile.php' class='act'>Profile</a></li>";
                            }
                            ?>
                            <li><a href="blog.php">Blog</a></li>
                            <li><a href="contact-us.php" class="act">Contact Us</a></li>
                            <button class="btn hvr-sweep-to-right"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>

        </nav> <!-- End Navbar -->

        <section id="course">
            <div class="container ">
                <div class="course-category row">
                    <div class="cat-drop col-xs-4">
                        <ul class="list-group">
                            <?php
                            $catagoryQuery = "SELECT * FROM category;";
                            $result = mysqli_query($db, $catagoryQuery);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $catId = $row['CatId'];
                                    $catName = $row['CatName'];
                                    echo "<li class='list-group-item'><a href='offline-courses.php?catName=$catName'>$catName</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="category-banner col-xs-8" > <!-- Here we change image to category type !-->
                        <div class="category-img " col-xs-12>
                            <img src="img/achevement-bg.jpg" alt="">
                        </div>
                    </div>
                </div>
                <?php
                if (!isset($_GET['catName'])) {
                    $categoryQuery = "SELECT * FROM category;";
                    $result = mysqli_query($db, $categoryQuery);
                    while ($category = mysqli_fetch_array($result)) {
                        // print the course category
                        $categoryName = $category['CatName'];
                        $catId = $category['CatId'];
                        $coursesQuery = "SELECT * FROM offcou WHERE cat_id='$catId';";
                        $coursesResult = mysqli_query($db, $coursesQuery);
                        while ($courseRow = mysqli_fetch_array($coursesResult)) {
                            $courseTitle = $courseRow['courseName'];
                            $courseDescription = $courseRow['OffDis'];
                            $coursePrice = $courseRow['coursePrice'];
                            $courseHours = $courseRow['courseNumOfHours'];
                            $courseId = $courseRow['OffId'];
                            $imgName = $courseRow['OffImage'];
                            echo "<div class='course-container col-xs-8' id='$courseTitle'>
					<div class='course-header col-xs-12'>
					<div class='row'>
					<h1>$courseTitle</h1>
					<img src='coursesImg/$imgName.jpg' alt='$imgName.jpg'>
					</div>
					</div>
					<div class='course-description col-xs-12'>
					<div class='row'>
                    <div class='description-title col-xs-12'>
					<h2>Course Description</h2>
					<div class='discription-content col-xs-12'>
					<p>$courseDescription</p>
					</div>
					</div>
					</div>
					</div>
					</div>
					<div class='course-info col-xs-4'>
					<div class='info row'>
                            <form action = 'regOfflineCourse.php' method='GET' class='col-xs-12'> 
                                    <button class='btn hvr-sweep-to-right'>Enroll in this Course</button> 
                                    <hr>    
                                     <label>Category : $categoryName</label>
                                    <hr>
                                    <label>Duration : $courseHours hours</label> 
                                    <hr>
									<label>Price : $$coursePrice  </label>
									<hr>
								    <input type = 'hidden' name = 'courseId' value = '$courseId'>
                            </form>
                            </div>
				</div>
				";
                        }
                    }
                } else {
                    // echo only selected category stuff
                    $catName = cleanSQL($_GET['catName']);
                    $categoryQuery = "SELECT * FROM category WHERE CatName='$catName'";
                    $result = mysqli_query($db, $categoryQuery);
                    $category = mysqli_fetch_array($result);
                    // print the article category
                    $categoryName = $category['CatName'];
                    $catId = $category['CatId'];
                    $coursesQuery = "SELECT * FROM offcou WHERE cat_id='$catId';";
                    $coursesResult = mysqli_query($db, $coursesQuery);
                    while ($courseRow = mysqli_fetch_array($coursesResult)) {
                        $courseTitle = $courseRow['courseName'];
                        $courseDescription = $courseRow['OffDis'];
                        $coursePrice = $courseRow['coursePrice'];
                        $courseHours = $courseRow['courseNumOfHours'];
                        $courseId = $courseRow['OffId'];
                        $imgName = $courseRow['OffImage'];
                        echo "<div class='course-container col-xs-8' id='$courseTitle'>
					<div class='course-header col-xs-12'>
					<div class='row'>
					<h1>$courseTitle</h1>
					<img src='coursesImg/$imgName.jpg' alt='$imgName.jpg'>
					</div>
					</div>
					<div class='course-description col-xs-12'>
					<div class='row'>
                    <div class='description-title col-xs-12'>
					<h2>Course Description</h2>
					<div class='discription-content col-xs-12'>
					<p>$courseDescription</p>
					</div>
					</div>
					</div>
					</div>
					</div>
					<div class='course-info col-xs-4'>
					<div class='info row'>
                            <form action = 'regOfflineCourse.php' method='GET' class='col-xs-12'> 
                                    <button class='btn hvr-sweep-to-right'>Enroll in this Course</button> 
                                    <hr>    
                                     <label>Category : $categoryName</label>
                                    <hr>
                                    <label>Duration : $courseHours hours</label> 
                                    <hr>
									<label>Price : $$coursePrice  </label>
									<hr>
								    <input type = 'hidden' name = 'courseId' value = '$courseId'>
                            </form>
                            </div>
				</div>
				";
                    }
                }
                ?>
            </div>
        </section>
        <footer id="footer">
            <div class="container">
                <div id="top-footer" class="row">
                    <div class="col-xs-12 col-md-4" id="about-us">
                        <h4>About Us</h4>
                        <p>The Masterstudy Education Center is
                            complete and an integral part of
                            Local Education in Washington!
                        </p>
                        <p> A decade's worth of rich history and
                            goodwill with the public schools
                            surrounding plus an extensive
                            community consultation process prepared
                            us for building the Local Education Center.
                        </p>
                        <button class="btn hvr-sweep-to-right">Learning Now</button>
                    </div>
                    <div class="col-xs-12 col-md-4" id="quick-links">
                        <h4>quick links</h4>
                        <p> > <a href="#">Pricing Plane</a></p>
                        <p> > <a href="#courses-type">Courses</a></p>
                        <p> > <a href="#welcome">About Us</a></p>
                    </div>
                    <div class="col-xs-12 col-md-4" id="contact-us">
                        <h4>contact us</h4>
                        <div>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>
                                23 Mulholland Drive, Suite 721. Los Angeles 10010
                                <br>100 S. Main Street. Los Angeles 90012</p>
                        </div>
                        <div>

                            <p><i class="fa fa-mobile" aria-hidden="true"></i>+1-670-567-5590</p>
                        </div>
                        <div>

                            <p><i class="fa fa-envelope-o" aria-hidden="true"></i>hello@clemocreative.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="js/jquery.min.js"></script> <!-- Jquery Mini file -->
        <script src="js/bootstrap.min.js"></script> <!-- Latest compiled and minified JavaScript -->
        <script src="js/wow.min.js"></script> <!-- WOW.js Mini file -->
        <script>new WOW().init();</script> <!-- Activate WOW.js File -->
        <script type="text/javascript" src="slick/slick.min.js"></script><!-- Slick.js Carousel file -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
        <script src="js/jquery.counterup.min.js"></script>
        <script src="js/script.js"></script> <!-- Externa Js File file - My File -->
    </body>
</html>
