<?php 
require_once('./adminLoginCheck.php');
?>
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
<!-- fonts -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
 
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
	   <style>td,th {text-align:center;} </style>
	   <?php 

include 'notification_sources.php';

?>
</head>

<body  style="background-color:#f8f8f8;"class='padTop53 ' >
<?php 
require_once 'db_connect.php';
require_once 'Admin.php';
 require_once('../signin_signup.php');
 include_once('./header.php');
 require_once 'notification_function.php';
		$admin=new Admin ;
   
if(isset($_POST['blockUser']))
 {
	  if(isset($_POST['userId']))
			   {
$userId=$_POST["userId"];
	
if($admin->blockUser($userId))
{
	$title="successfully";
	$text= $admin->getLastSuccessMessage();
	
	notify ($title,$text); 
}
else 
{
	$title="Error";
	$text=$admin->getLastErrorMessage();
	
   notify ($title,$text);
}
			   }
			   else 

{
	 notify ("Notice","select user to block");
}
}
 		   
	
			   
	

?>
    <!-- MAIN WRAPPER -->
    <div id='wrap' style='margin-top:65px;'>
        

        <!-- HEADER SECTION -->
       
        <!-- END HEADER SECTION -->



   
            <div id='left' >
                <div class='media user-media well-small'>
                    <a class='user-link' href='#'>
                        <img class='media-object img-thumbnail user-img' alt='User Picture' src='../images/<?php echo  $_SESSION["username"].".jpg";?>' style="min-width:190px;min:height:70px;" />
                    </a>
                    <br />
                    <div class='media-body'>
                        <h5 class='media-heading'> <?php echo  $_SESSION["username"];?></h5>
                        <ul class='list-unstyled user-info'>

                            <li>
                                <a class='btn btn-success btn-xs btn-circle' style='width: 10px;height: 12px;'></a> Online

                            </li>

                        </ul>
                    </div>
                    <ul id='menu' class='collapse'>
                    <li><a href='index.php'><i class='icon-table'></i> Dashboard </a></li>
                    <li class="active"><a href='blockUsers.php'><i class='icon-table'></i>block User </a></li>
                    <li><a href='unblockUsers.php'><i class='icon-table'></i>unblock User </a></li>
                    <li><a href='videos.php'><i class='icon-table'></i>  videos </a></li>
                    <li><a href='addcategory.php'><i class='icon-film'></i> add category </a></li>
                    <li><a href='editCategory.php'><i class='icon-film'></i> edit category </a></li>
                    <li><a href='deleteCategory.php'><i class='icon-film'></i> delete category </a></li>
                    <li><a href='deleteChannel.php'><i class='icon-map-marker'></i> delete channel </a></li>
                    <li><a href='newReportComments.php'><i class='icon-columns'></i> today reported comment </a></li>
                    <li><a href='newReportVideos.php'><i class='icon-columns'></i> today reported video </a></li>
                    <li><a href='reportComments.php'><i class='icon-columns'></i> all reported comment </a></li>
                    <li><a href='reportVideo.php'><i class='icon-columns'></i> all reported video </a></li>
                </ul>
                </div>

               

            </div>
            <!--END MENU SECTION -->



    <!--END MENU SECTION -->


                <div class='col-lg-10'>
                <div class='col-lg-12'>
                    <div class='panel panel-default'>
                        <div class='panel-heading'>
                            All Users
                        </div>
                        <div class='panel-body'>
                            <div class='table-responsive'>
							<form action="blockUsers.php"  method="post" >
                                <table class='table table-striped table-bordered table-hover' id='dataTables-example'>
                                    <thead>
                                        <tr>
										     <th>Action</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>state</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
      <!--**************==================== echo here ========================= ********--->
                                        <!-- user -->
                                         <?php
   /*  
   ELECT `userId`, `username`, `password`, `email`, `userType`, `blockState`
   */    
                                          
										 $result= $admin->showUsers();
										 
										  while($row = $result->fetch_assoc()) {
											  if($row["blockState"]!= 1)
											  {
												  $blockState='NORMAL';
											  }
											  else  if($row["blockState"]==1){
												  
												  $blockState='BLOCKED';
											  }
												  
											  
                                            echo "
											<tr>
											<td><input type='radio' name='userId' value='".$row["userId"]."'>
											<td>".$row["username"]."</td>
                                            <td>".$row["email"]."</td>
											<td>". $blockState."</td>	

											</tr>
											";
                                               }
										
										?>
                                
    <!--**************==================== end ========================= ********--->
								</tbody>
                                </table>
								<div style="text-align:center;"><input type="submit" class="'btn btn-danger" name="blockUser" value="block"> </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
           
            
            </div>




        </div>
       <!--END PAGE CONTENT -->


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
    <script src='assets/plugins/dataTables/jquery.dataTables.js'></script>
    <script src='assets/plugins/dataTables/dataTables.bootstrap.js'></script>
     <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
         });
    </script>
     <!-- END PAGE LEVEL SCRIPTS -->
</body>
     <!-- END BODY -->
</html>