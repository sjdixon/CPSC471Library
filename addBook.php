<?php	
	//addBook.php - written by Gaby Comeau
	//PHP script to add a book to the database
	//header("Location: App_Index.php",TRUE,303);	
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT MAX(i.libraryCode) AS lCode FROM ITEM i");
	//echo "Query result: $dbd";
	$current_id = mysql_fetch_row($dbd);
	//echo "Current max item: $current_id[0]<br>";
	$id = $current_id[0]+ 1;
	
	$title = $_POST['name'];
	$year = $_POST['spinner'];
	$location = $_POST['location'];
	$type = "Book";
	$genre = $_POST['genre'];
	$audience = $_POST['audience'];
	$ISBN = $_POST['ISBN'];
	$author = $_POST['authorName'];
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

	$results2 = mysql_query("INSERT INTO Book (authors, ISBN, libraryCode) VALUES ('$author', '$ISBN', '$id')"); 
	if(!$results2){
     	echo "could not insert into Book table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
     }
     
    $results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('1', '$id', 'available')"); 
	if(!$results3){
     	echo "could not insert into Instance table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
    }

    //header("Location: App_Index.php");
        
?>