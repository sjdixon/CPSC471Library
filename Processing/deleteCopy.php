<?php	
	//deleteCopy.php - written by Gaby Comeau
	//PHP script to delete an item instance from the database
	header("Location: ../App_Index.php",TRUE,303);	
        include '../Headers/dbConnect.php';
	
	$item = mysql_real_escape_string($_POST['lCode2']);
	$copy = mysql_real_escape_string($_POST['stockNum2']);
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