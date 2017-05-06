<html>

<head> </head>
<body>

<?php



        

				
					 showAdminList ('2');
				function showAdminList ($t)
				{
					$li=$t;
					$li1=$li2=$li3=$li4=$li5=$li6=$li7=$li8=$li9=$li10=$li11=$li12="";
                     for ($i=1;$i<=12;$i++)
					 {
				         if ($i==$li)
						 {
							 $i=1;
							${"li" . $i}='active';
						 }
					
						
				
					 }
					
					
					
				
               echo " <ul id='menu' class='collapse'>
                    <li class='$li1'><a href='index.php'><i class='icon-table'></i> Dashboard </a></li>
                    <li class='$li2'><a href='blockUsers.php'><i class='icon-table'></i>block User </a></li>
                    <li class='$li3'><a href='unblockUsers.php'><i class='icon-table'></i>unblock User </a></li>
                    <li class='$li4'><a href='videos.php'><i class='icon-table'></i>  videos </a></li>
                    <li class='$li5'><a href='addcategory.php'><i class='icon-film'></i> add category </a></li>
                    <li class='$li6'><a href='editCategory.php'><i class='icon-film'></i> edit category </a></li>
                    <li class='$li7'><a href='deleteCategory.php'><i class='icon-film'></i> delete category </a></li>
                    <li class='$li8'><a href='deleteChannel.php'><i class='icon-map-marker'></i> delete channel </a></li>
                    <li class='$li9'><a href='newReportComments.php'><i class='icon-columns'></i> today reported comment </a></li>
                    <li class='$li10'><a href='newReportVideos.php'><i class='icon-columns'></i> today reported video </a></li>
                    <li class='$li11'><a href='reportComments.php'><i class='icon-columns'></i> all reported comment </a></li>
                    <li class='$li12'><a href='reportVideo.php'><i class='icon-columns'></i> all reported video </a></li>
                </ul>";
                }
					
					
				
               
                

	   
	   ?>
	   </body>
	   </html>
            