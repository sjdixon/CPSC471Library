<?php	
	session_start();
        // If the user is not logged then the user will be set to the main page
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }
	
	//deleteItem.php - written by Gaby Comeau
	//PHP script to delete an item from the database
	header("Location: ../App_Index.php",TRUE,303);
        include '../Headers/dbConnect.php';
	
	$item = mysql_real_escape_string($_POST['lCode3']);
	//echo "Item code: $item<br>";
	$typeq = mysql_query("SELECT itemType FROM Item WHERE libraryCode = '$item'");
	$typerow = mysql_fetch_row($typeq);
	$type = $typerow[0];
	//echo "$type<br>";
	
	//first, delete the entry from the type table
	$query = "DELETE FROM $type WHERE libraryCode = '$item'";
	//echo "$query<br>";
	$results = mysql_query($query);
	if(!$results){
      	echo "could not delete from $item table<br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }
	
	//Second, remove all item instances
	$query = "DELETE FROM Item_Instance WHERE libraryCode = '$item'";
	echo "$query<br>";
	$results1 = mysql_query($query);
	if(!$results1){
      	echo "could not delete from Instance table<br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }
	
	//Finally, delete the item table entry
	$query = "DELETE FROM Item WHERE libraryCode = '$item'";
	echo "$query<br>";
	$results2 = mysql_query($query);
	if(!$results2){
      	echo "could not delete from Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
    }

?>
