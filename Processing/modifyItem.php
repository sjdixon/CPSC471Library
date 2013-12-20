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
		
	
	$id = $_POST['id'];
	$type = $_POST['type'];
	$title = $_POST['name5'];
	echo ("Title: $title<br>");
	$year = $_POST['spinner5'];
	$location = $_POST['location5'];
	echo ("Location: $location<br>");
	$genre = $_POST['genre5'];
	$audience = $_POST['audience5'];
	$ref = $_POST['isReference5'];
	if ($ref == "on"){
		$ref = 1;
	}
	else $ref = 0;
	$copies = $_POST['copies5'];
	
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
		$ISBN = $_POST['ISBN1'];
		$author = $_POST['authorName1'];
		$result2 = mysql_query("UPDATE Book SET ISBN='$ISBN', authors='$author' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
		
	}	
	else if($type == "Audio"){
		$UPC = $_POST['UPC3'];
		$artists = $_POST['artistName1'];
		$prodComp = $_POST['producerName3'];
		$result2 = mysql_query("UPDATE Audio SET artists='$artists', productionCompany='$prodComp', UPC='$UPC' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}	
	else if($type == "Video"){
		$UPC = $_POST['UPC3'];
		$director = $_POST['director1'];
		$prodComp = $_POST['producerName3'];
		$result2 = mysql_query("UPDATE Video SET UPC='$UPC', directory='$director', productionCompany='$prodComp' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}	
	else if($type == "Magazine"){
		$date = $_POST['datepicker2'];
		//$datestr = explode("/", $date);
		//$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
		$sub = $_POST['subNam1'];
		$pub = $_POST['pubName4'];
		$result2 = mysql_query("UPDATE Magazine issue='$date', subtitle='$sub', publisher='$pub' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}
	else if($type == "Newspaper"){
		$date = $_POST['datepicker'];
		//$datestr = explode("/", $date);
		//$issue = "$datestr[2]-$datestr[0]-$datestr[1]";
		$pub = $_POST['pubName4'];
		$result2 = mysql_query("UPDATE Newspaper SET issue='$date', publisher='$pub' WHERE libraryCode='$id'");
		if(!$result2){
     		echo "could not insert into Instance table <br />";        
			trigger_error(mysql_error(), E_USER_ERROR);
    	}
	}
	
?>	
