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
	
	//addBook.php - written by Gaby Comeau
	//PHP script to add a book to the database
	header("Location: ../App_Index.php",TRUE,303);	
        include '../Headers/dbConnect.php';
        
	//and now the real fun begins
	$id = 0;
	$dbd = mysql_query("SELECT MAX(i.libraryCode) AS lCode FROM ITEM i");
	//echo "Query result: $dbd";
	$current_id = mysql_fetch_row($dbd);
	//echo "Current max item: $current_id[0]<br>";
	$id = $current_id[0]+ 1;
	
	$title = mysql_real_escape_string($_POST['name']);
	$year = mysql_real_escape_string($_POST['spinner']);
	$location = mysql_real_escape_string($_POST['location']);
	$type = "Book";
	$genre = mysql_real_escape_string($_POST['genre']);
	$audience = mysql_real_escape_string($_POST['audience']);
	$ISBN = mysql_real_escape_string($_POST['ISBN']);
	$author = mysql_real_escape_string($_POST['authorName']);
	$ref = mysql_real_escape_string($_POST['isReference']);
	//echo "Is Reference: $ref";
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = mysql_real_escape_string($_POST['copies']);
	//echo "#copies: $copies<br>";
	
					
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
    for ($i = 1; $i <= $copies; $i++){ 	 
   		$results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('$i', '$id', 'available')"); 
		if(!$results3){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
    }

    //header("Location: App_Index.php");
        
?>
