<?php
require_once('./loginCheck.php');
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
        require_once('./notification_sources.php');
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
                    <li><a href='./index.php' class='home-icon'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Home</a></li>
                    <?php
                    if (!empty($_SESSION['username'])) {
                        echo "<li><a href='myChannel.php' class='user-icon'><span class='glyphicon glyphicon-home glyphicon-blackboard' aria-hidden='true'></span>My Channel</a></li>
							  <li  class='active'><a href='mySubscribtion.php' class='sub-icon'><span class='glyphicon glyphicon-home glyphicon-hourglass' aria-hidden='true'></span>My Subscription </a></li>";
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
                        $('li a.menu1').click(function () {
                            $('ul.cl-effect-2').slideToggle(300, function () {
                                // Animation complete.
                            });
                        });
                    </script>

                    <script>
                        $('li a.menu').click(function () {
                            $('ul.cl-effect-1').slideToggle(300, function () {
                                // Animation complete.
                            });
                        });
                    </script>

                </ul>
                <!-- script-for-menu -->
                <script>
                    $('.top-navigation').click(function () {
                        $('.drop-navigation').slideToggle(300, function () {
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
<u><a href="https://www.facebook.com/omar.tammam.9?fref=ts">Omar Tammam</a></u></p>
                    </div>
                </div>
            </div>
        </div>
        <div class='col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main'>
            <div class='main-grids' style='min-height:600px;'>
                <div class='top-grids'>
                    <div class='recommended-info'>
                        <h3><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span> Subscribtion</h3>
                    </div>


                    <!-- subscribtion -->
                    <?php
                    require_once ('./User.php');
                    $user = new User();
                    if($result = $user->getSubscribtions()){
                        while ($channelRow = $result->fetch_assoc()) {
                            $channelLink = "./viewChannel.php?channel=" . $channelRow['username'];
                            $channelImg = $channelRow['channelImg'];
                            $channelName = $channelRow['channelName'];
                            $followerNumber = $channelRow['followerNumber'];
                            echo "
                    <div class='col-md-4 resent-grid recommended-grid slider-top-grids' style='margin-top:10px;'>
                        <div class='resent-grid-img recommended-grid-img' style=' border:2px solid orange;'>
                            <a href='$channelLink'><img src='./images/$channelImg.jpg' style='' alt='' /></a>


                        </div>
                        <div class='resent-grid-info recommended-grid-info'>
                            <h3><a href='$channelLink' class='title title-info'>$channelName</a></h3>
                            <ul>
                                <li><p class='author author-info'><a href='$channelLink' class='author'>$channelName</a></p></li>
                                <li class='right-list'><p class='views views-info'>$followerNumber</p></li>
                            </ul>
                        </div>
                    </div>
                    ";
                        }
                        } else {
                            notify("Uhmm", $user->getLastErrorMessage());
                        }
                    ?>
                    <!-- ///subscribtion -->


                    <div class='clearfix'> </div>
                </div>
            </div>
            <?php include 'footer.php'; ?>
            <div class='clearfix'> </div>
            <div class='drop-menu'>
                <ul class='dropdown-menu' role='menu' aria-labelledby='dropdownMenu4'>
                    <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Regular link</a></li>
                    <li role='presentation' class='disabled'><a role='menuitem' tabindex='-1' href='#'>Disabled link</a></li>
                    <li role='presentation'><a role='menuitem' tabindex='-1' href='#'>Another link</a></li>
                </ul>
            </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src='js/bootstrap.min.js'></script>
        <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    </body>
</html>
