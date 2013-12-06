<!--addBook.php-->
<!-- PHP script to add a book to the database-->
<?php		
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT COUNT(i.libraryCode) AS lCode FROM ITEM i");
	echo "Query result: $dbd";
	$current_id = mysql_fetch_row($dbd);
	echo "Current max item: $current_id[0]<br>";
	$id = $current_id[0]+ 1;
	
	$title = $_POST['name'];
	$year = $_POST['spinner'];
	$location = $_POST['location'];
	$type = "Book";
	$genre = $_POST['genre'];
	$audience = "All ages";
	$ISBN = $_POST['ISBN'];
	$author = $_POST['authorName'];
					
	$results = mysql_query("INSERT INTO Item VALUES ('$id','$type','$location','$title','$year','0','$genre','$audience')");
	if(!$results){
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

	$results2 = mysql_query("INSERT INTO Book (authors, ISBN, libraryCode) VALUES ('$author', '$ISBN', '$id')"); 
	if(!$results2){
     	echo "could not insert into Book table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
     }

    header("Location: App_Index.php");
        
?>