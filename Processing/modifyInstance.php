<?php
	session_start();
        // If the user is not logged then the user will be set to the main page
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }
	
	//modifyInstance.php - Added by Gabrielle Comeau
	//Form handler for the modify instance form
	
	header("Location: ../App_Index.php",TRUE,303);	
	include '../Headers/dbConnect.php';
		
	
	$item = mysql_real_escape_string($_POST['lCode1']);
	$copy = mysql_real_escape_string($_POST['stockNum1']);
	$status = mysql_real_escape_string($_POST['status1']);
	
	$results = mysql_query("UPDATE Item_Instance SET state='$status' WHERE (libraryCode='$item' AND stockNum='$copy')");
	if(!$results){
      	echo "could not modify instance <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }
?>
