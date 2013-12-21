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
	
	//modifyItem.php - lets the library user modify an item in the database
	//Added by Gaby Comeau
	header("Location: ../App_Index.php",TRUE,303);	
	include '../Headers/dbConnect.php';
		
	
	$id = mysql_real_escape_string($_POST['id']);
	$type = mysql_real_escape_string($_POST['type']);
	$title = mysql_real_escape_string($_POST['name5']);
	echo ("Title: $title<br>");
	$year = mysql_real_escape_string($_POST['spinner5']);
	$location = $_POST['location5'];
	echo ("Location: $location<br>");
	$genre = mysql_real_escape_string($_POST['genre5']);
	$audience = mysql_real_escape_string($_POST['audience5']);
	$ref = mysql_real_escape_string($_POST['isReference5']);
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = mysql_real_escape_string($_POST['copies5']);
	
	$result = mysql_query("UPDATE Item SET shelfLoc='$location', title='$title', year='$year', isReference='$ref', genre='$genre', audience='$audience' WHERE libraryCode='$id'");
	if(!$result){
		echo "could not insert into Item table <br />";        
		trigger_error(mysql_error(), E_USER_ERROR);
    }
	
	$result1 = mysql_query("SELECT MAX(stockNum) FROM Item_Instance WHERE libraryCode='$id'");
	$row1 = mysql_fetch_array($result1);
	if ($row1[0] < $copies) {
		for($i = ($row1[0] +1); $i <= $copies; $i++){
			$results3 = mysql_query("INSERT INTO ITEM_INSTANCE VALUES ('$i', '$id', 'available')"); 
			if(!$results3){
     			echo "could not insert into Instance table <br />";        
				trigger_error(mysql_error(), E_USER_ERROR);
    		}
    	}
	}
	mysql_free_result($result1);
	
	
	if($type == "Book"){
		$ISBN = mysql_real_escape_string($_POST['ISBN1']);
		$author = mysql_real_escape_string($_POST['authorName1']);
		$result2 = mysql_query("UPDATE Book SET ISBN='$ISBN', authors='$author' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
		
	}	
	else if($type == "Audio"){
		$UPC = mysql_real_escape_string($_POST['UPC3']);
		$artists = mysql_real_escape_string($_POST['artistName1']);
		$prodComp = mysql_real_escape_string($_POST['producerName3']);
		$result2 = mysql_query("UPDATE Audio SET artists='$artists', productionCompany='$prodComp', UPC='$UPC' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}	
	else if($type == "Video"){
		$UPC = mysql_real_escape_string($_POST['UPC3']);
		$director = mysql_real_escape_string($_POST['director1']);
		$prodComp = mysql_real_escape_string($_POST['producerName3']);
		$result2 = mysql_query("UPDATE Video SET UPC='$UPC', directory='$director', productionCompany='$prodComp' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}	
	else if($type == "Magazine"){
		$date = mysql_real_escape_string($_POST['datepicker2']);
		//$datestr = explode("/", $date);
		//$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
		$sub = mysql_real_escape_string($_POST['subNam1']);
		$pub = mysql_real_escape_string($_POST['pubName4']);
		$result2 = mysql_query("UPDATE Magazine issue='$date', subtitle='$sub', publisher='$pub' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}
	else if($type == "Newspaper"){
		$date = mysql_real_escape_string($_POST['datepicker']);
		//$datestr = explode("/", $date);
		//$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
		$pub = mysql_real_escape_string($_POST['pubName4']);
		$result2 = mysql_query("UPDATE Newspaper SET issue='$date', publisher='$pub' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}
	
?>	
