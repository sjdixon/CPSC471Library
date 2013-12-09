<?php	
	//addAudio.php - written by Gaby Comeau
	//PHP script to add an audio item to the database
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
	
	$title = $_POST['name1'];
	$year = $_POST['spinner1'];
	$location = $_POST['location1'];
	$type = "Audio";
	$genre = $_POST['genre1'];
	$audience = $_POST['audience1'];
	$UPC = $_POST['UPC'];
	$artists = $_POST['artistName'];
	$prodComp = $_POST['producerName'];
	$ref = $_POST['isReference3'];
	echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','$ref','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Audio (libraryCode, artists, productionCompany, UPC) VALUES ('$id', '$artists', '$prodComp', '$UPC')"); 
	if(!$results2){
     	echo "could not insert into Audio table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
     }
     
    $results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('1', '$id', 'available')"); 
	if(!$results3){
     	echo "could not insert into Instance table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
    }

        
?>