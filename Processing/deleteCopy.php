<?php	
	//deleteCopy.php - written by Gaby Comeau
	//PHP script to delete an item instance from the database
	header("Location: ../App_Index.php",TRUE,303);	
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	
	$item = $_POST['lCode2'];
	$copy = $_POST['stockNum2'];
	if ($copy == '') $item = -1; //this will cause the query to fail, so you don't delete every instance of an item if you forget the stock number
	echo "Item: $item";
	
	$query = "DELETE FROM Item_Instance WHERE (libraryCode = '$item' AND stockNum = '$copy')";
	echo "Query: $query<br>";
	$results = mysql_query($query);
	if(!$results){
      	echo "could not delete instance <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }
?>