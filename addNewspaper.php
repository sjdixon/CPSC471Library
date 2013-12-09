<?php	
	//addNewspaper.php - written by Gaby Comeau
	//PHP script to add a newspaper to the database
	header("Location: App_Index.php",TRUE,303);	
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT MAX(i.libraryCode) AS lCode FROM ITEM i");
	$current_id = mysql_fetch_row($dbd);
	$id = $current_id[0]+ 1;
	echo "Current max item: $current_id[0]<br>";
	
	$title = $_POST['name4'];
	$year = $_POST['spinner4'];
	$location = $_POST['location4'];
	$type = "Newspaper";
	$genre = $_POST['genre4'];
	$audience = $_POST['audience4'];
	$date = $_POST['datepicker'];
	$datestr = explode("/", $date);
	$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
	$pub = $_POST['pubName3'];
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','0','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Newspaper (issue, libraryCode, publisher) VALUES (CONVERT('$issue', DATE), '$id', '$pub')"); 
	if(!$results2){
     	echo "could not insert into Magazine table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
     }
     
    $results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('1', '$id', 'available')"); 
	if(!$results3){
     	echo "could not insert into Instance table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
    }

        
?>