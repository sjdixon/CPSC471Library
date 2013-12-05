<!--addBook.php-->
<!-- PHP script to add a book to the database-->
<?php		

	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	//and now the real fun begins
	$title = $_POST['name'];
	$year = $_POST['spinner'];
	$location = $_POST['location'];
	$type = 'Book';
	$genre = $_POST['genre'];
	$audience = 'All ages';
	$ISBN = $_POST['ISBN'];
	$author = $_POST['authorName'];
	echo("Title: $title\n");
	echo("Year: $year\n");
	echo("Type: $type\n");
					
	$results = mysql_query("INSERT INTO Item (itemType, shelfLoc, title, year, isReference, genre, audience) VALUES ('$type', '$location', '$title', '$year', '0', '$genre', '$audience'");
	$results2 = mysql_query("INSERT INTO Book (authors, ISBN, libraryCode) VALUES ('$author', '$ISBN')"); 
?>