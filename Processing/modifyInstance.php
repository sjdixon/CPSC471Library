<?php
	//modifyInstance.php - Added by Gabrielle Comeau
	//Form handler for the modify instance form
	
	header("Location: ../App_Index.php",TRUE,303);	
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	$item = $_POST['lCode1'];
	$copy = $_POST['stockNum1'];
	$status = $_POST['status1'];
	
	$results = mysql_query("UPDATE Item_Instance SET state='$status' WHERE (libraryCode='$item' AND stockNum='$copy')");
	if(!$results){
      	echo "could not modify instance <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }
?>