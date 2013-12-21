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
	
	//addMagazine.php - written by Gaby Comeau
	//PHP script to add a magazine to the database
	header("Location: ../App_Index.php",TRUE,303);	
        include '../Headers/dbConnect.php';
        
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT MAX(i.libraryCode) AS lCode FROM ITEM i");
	$current_id = mysql_fetch_row($dbd);
	$id = $current_id[0]+ 1;
	//echo "Current max item: $current_id[0]<br>";
	
	$title = mysql_real_escape_string($_POST['name3']);
	$year = mysql_real_escape_string($_POST['spinner3']);
	$location = mysql_real_escape_string($_POST['location3']);
	$type = "Magazine";
	$genre = mysql_real_escape_string($_POST['genre3']);
	$audience = mysql_real_escape_string($_POST['audience3']);
	$date = mysql_real_escape_string($_POST['datepicker1']);
	$ref = mysql_real_escape_string($_POST['isReference3']);
	echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = mysql_real_escape_string($_POST['copies3']);

	//echo "Date: $date<br>";
	$datestr = explode("/", $date);
	//echo "Date strings: $datestr[0]-$datestr[1]-$datestr[2]<br>";
	$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
	//echo $issue;
	$sub = mysql_real_escape_string($_POST['subName']);
	$pub = mysql_real_escape_string($_POST['pubName2']);
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','$ref','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Magazine (issue, subtitle, publisher, libraryCode) VALUES (CONVERT('$issue', DATE), '$sub', '$pub', '$id')"); 
	if(!$results2){
     	echo "could not insert into Magazine table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
     }
     
    for ($i = 1; $i <= $copies; $i++){ 	 
   		$results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('$i', '$id', 'available')"); 
		if(!$results3){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
    }

        
?>
