<?php	
	//addVideo.php - written by Gaby Comeau
	//PHP script to add a video item to the database
	header("Location: ../App_Index.php",TRUE,303);	
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
	
	$title = mysql_real_escape_string($_POST['name2']);
	$year = mysql_real_escape_string($_POST['spinner2']);
	$location = mysql_real_escape_string($_POST['location2']);
	$type = "Video";
	$genre = mysql_real_escape_string($_POST['genre2']);
	$audience = mysql_real_escape_string($_POST['audience2']);
	$UPC = mysql_real_escape_string($_POST['UPC2']);
	$director = mysql_real_escape_string($_POST['director']);
	$prodComp = mysql_real_escape_string($_POST['producerName2']);
	$ref = mysql_real_escape_string($_POST['isReference2']);
	echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = mysql_real_escape_string($_POST['copies2']);
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','$ref','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Video (libraryCode, UPC, directory, productionCompany) VALUES ('$id', '$UPC', '$director', '$prodComp')"); 
	if(!$results2){
     	echo "could not insert into Video table <br />";        
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