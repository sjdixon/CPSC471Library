<?php	
	//addMagazine.php - written by Gaby Comeau
	//PHP script to add a magazine to the database
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
	//echo "Current max item: $current_id[0]<br>";
	
	$title = $_POST['name3'];
	$year = $_POST['spinner3'];
	$location = $_POST['location3'];
	$type = "Magazine";
	$genre = $_POST['genre3'];
	$audience = $_POST['audience3'];
	$date = $_POST['datepicker1'];
	$ref = $_POST['isReference3'];
	echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = $_POST['copies3'];

	//echo "Date: $date<br>";
	$datestr = explode("/", $date);
	//echo "Date strings: $datestr[0]-$datestr[1]-$datestr[2]<br>";
	$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
	//echo $issue;
	$sub = $_POST['subName'];
	$pub = $_POST['pubName2'];
					
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