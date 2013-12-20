<?php	
	//addNewspaper.php - written by Gaby Comeau
	//PHP script to add a newspaper to the database
	header("Location: ../App_Index.php",TRUE,303);	
        include '../Headers/dbConnect.php';
        
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT MAX(i.libraryCode) AS lCode FROM ITEM i");
	$current_id = mysql_fetch_row($dbd);
	$id = $current_id[0]+ 1;
	echo "Current max item: $current_id[0]<br>";
	
	$title = mysql_real_escape_string($_POST['name4']);
	$year = mysql_real_escape_string($_POST['spinner4']);
	$location = mysql_real_escape_string($_POST['location4']);
	$type = "Newspaper";
	$genre = mysql_real_escape_string($_POST['genre4']);
	$audience = mysql_real_escape_string($_POST['audience4']);
	$date = $_POST['datepicker'];
	$datestr = explode("/", $date);
	$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
	$pub = mysql_real_escape_string($_POST['pubName3']);
	$ref = mysql_real_escape_string($_POST['isReference4']);
	echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = $_POST['copies4'];
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','$ref','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Newspaper (issue, libraryCode, publisher) VALUES (CONVERT('$issue', DATE), '$id', '$pub')"); 
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