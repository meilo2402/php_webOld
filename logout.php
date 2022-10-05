<?php  
 //logout.php  
 session_start();  
 session_destroy();  
 header("location:signup.php?action=login");  
 ?>  