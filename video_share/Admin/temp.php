<!DOCTYPE html>
<!--[if IE 8]> <html lang='en' class='ie8'> <![endif]-->
<!--[if IE 9]> <html lang='en' class='ie9'> <![endif]-->
<!--[if !IE]><!--> <html lang='en'> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset='UTF-8' />
    <title>BCORE Admin Dashboard Template | Dashboard </title>
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

     <meta content='width=device-width, initial-scale=1.0' name='viewport' />
	<meta content='' name='description' />
	<meta content='' name='author' />
     <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel='stylesheet' href='assets/plugins/bootstrap/css/bootstrap.css' />
    <link rel='stylesheet' href='assets/css/main.css' />
    <link rel='stylesheet' href='assets/css/theme.css' />
    <link rel='stylesheet' href='assets/css/MoneAdmin.css' />
    <link rel='stylesheet' href='assets/plugins/Font-Awesome/css/font-awesome.css' />
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href='assets/css/layout2.css' rel='stylesheet' />
       <link href='assets/plugins/flot/examples/examples.css' rel='stylesheet' />
       <link rel='stylesheet' href='assets/plugins/timeline/timeline.css' />
    <!-- END PAGE LEVEL  STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>
      <script src='https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js'></script>
    <![endif]-->
</head>


    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body class='padTop53 ' >
<?php 

include('header.php');
?>
    <!-- MAIN WRAPPER -->
    <div id='wrap' style='margin-top:65px;'>
        

        <!-- HEADER SECTION -->
       
        <!-- END HEADER SECTION -->


  
       <div id='left' >
            <div class='media user-media well-small'>
                <a class='user-link' href='#'>
                    <img class='media-object img-thumbnail user-img' alt='User Picture' src='assets/img/user.gif' />
                </a>
                <br />
                <div class='media-body'>
                    <h5 class='media-heading'> Joe Romlin</h5>
                    <ul class='list-unstyled user-info'>
                        
                        <li>
                             <a class='btn btn-success btn-xs btn-circle' style='width: 10px;height: 12px;'></a> Online
                           
                        </li>
                       
                    </ul>
                </div>
               
            </div>

            <ul id='menu' class='collapse'>
                     
                <li><a href='index.php'><i class='icon-table'></i> Dashboard </a></li>
                <li><a href='viewUsers.php'><i class='icon-table'></i>  Users </a></li>
                 <li><a href='viewUsers.php'><i class='icon-table'></i>  videos </a></li>
                <li><a href='addcategory.php'><i class='icon-film'></i> add category </a></li>
				  <li><a href='editCategory.php'><i class='icon-film'></i> edit category </a></li>
				    <li><a href='deleteCategory.php'><i class='icon-film'></i> delete category </a></li>
               <li><a href='deleteChannel.php'><i class='icon-map-marker'></i> delete channel </a></li>

                <li><a href='reportComments.php'><i class='icon-columns'></i> view reported comment </a></li>
                <li><a href='reportVideo.php'><i class='icon-columns'></i> view reported video </a></li>
				 <li><a href='reportChannel.php'><i class='icon-columns'></i> view reported channel </a></li>
            </ul>

        </div>
        <!--END MENU SECTION -->
   <!--END MENU SECTION -->




        <!--PAGE CONTENT -->
        <div id='content'>
          
        </div>
        <!--END PAGE CONTENT -->

        
         <!-- END RIGHT STRIP  SECTION -->
    </div>

    <!--END MAIN WRAPPER -->

    <!-- FOOTER -->
    <div id='footer'>
        <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
    </div>
    <!--END FOOTER -->


    <!-- GLOBAL SCRIPTS -->
    <script src='assets/plugins/jquery-2.0.3.min.js'></script>
     <script src='assets/plugins/bootstrap/js/bootstrap.min.js'></script>
    <script src='assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js'></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src='assets/plugins/flot/jquery.flot.js'></script>
    <script src='assets/plugins/flot/jquery.flot.resize.js'></script>
    <script src='assets/plugins/flot/jquery.flot.time.js'></script>
     <script  src='assets/plugins/flot/jquery.flot.stack.js'></script>
    <script src='assets/js/for_index.js'></script>
   
    <!-- END PAGE LEVEL SCRIPTS -->


</body>

    <!-- END BODY -->
</html>
