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
	
	//getItem.php - written by Gaby Comeau
	//PHP script to find the information of an item to modify
	
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	$id = intval(mysql_real_escape_string($_GET['libID']));
	$result = mysql_query("SELECT * FROM Item WHERE libraryCode='$id'");
	$row = mysql_fetch_array($result);
	mysql_free_result($result);
	$result1 = mysql_query("SELECT MAX(stockNum) FROM Item_Instance WHERE libraryCode='$id'");
	$row1 = mysql_fetch_array($result1);
	mysql_free_result($result1);
	$type = $row[1];
	
	if($type == "Book"){
		$result2 = mysql_query("SELECT * FROM Book WHERE libraryCode='$id'");
		$row2 = mysql_fetch_array($result2);
		mysql_free_result($result2);
	}	
	else if($type == "Audio"){
		$result2 = mysql_query("SELECT * FROM Audio WHERE libraryCode='$id'");
		$row2 = mysql_fetch_array($result2);
		mysql_free_result($result2);
	}	
	else if($type == "Video"){
		$result2 = mysql_query("SELECT * FROM Video WHERE libraryCode='$id'");
		$row2 = mysql_fetch_array($result2);
		mysql_free_result($result2);
	}	
	else if($type == "Magazine"){
		$result2 = mysql_query("SELECT * FROM Magazine WHERE libraryCode='$id'");
		$row2 = mysql_fetch_array($result2);
		mysql_free_result($result2);
	}
	else if($type == "Newspaper"){
		$result2 = mysql_query("SELECT * FROM Newspaper WHERE libraryCode='$id'");
		$row2 = mysql_fetch_array($result2);
		mysql_free_result($result2);
	}
	
	echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";
	echo "<input type=\"hidden\" name=\"type\" value=\"$type\" />";
	echo "<label for=\"name5\">Title: </label>";
	echo "<input type =\"text\" name=\"name5\" id=\"name5\" class=\"text ui-widget-content ui-corner-all\" value = \"$row[3]\" /><br><br>";
	echo "<label for=\"spinner6\">Release Year: </label>";
	echo "<input id=\"spinner6\" name=\"spinner6\" value=\"$row[4]\" /><br><br>";
	echo "<label for=\"genre5\">Genre: </label>";
	echo "<input type =\"text\" name=\"genre5\" id=\"genre5\" class=\"text ui-widget-content ui-corner-all\" value = \"$row[6]\" /><br><br>";
	echo "<label for=\"audience5\">Audience: </label>";
	echo "<select id=\"audience5\" name=\"audience5\" selected= \"$row[7]\">";
		echo "<option value=\"\">Select Type</option>";
		echo "<option value=\"Early Childhood\">Early Childhood</option>";
		echo "<option value=\"Children\">Children</option>";
		echo "<option value=\"Pre-Teens\">Pre-Teens</option>";
		echo "<option value=\"Young Adults\">Teens/Young Adults</option>";
		echo "<option value=\"Adults\">Adults</option>";
		echo "<option value=\"All Ages\">All Ages</option>"; 
	echo "</select><br><br>";	
	echo "<label for=\"location5\">Location: </label>";
	echo "<input type =\"text\" name=\"location5\" id=\"location5\" class=\"text ui-widget-content ui-corner-all\"  value = \"$row[2]\" /><br><br>";
	echo "<label for=\"copies5\">Number of copies: </label>";
	echo "<input id=\"copies5\" name=\"copies5\" value=\"$row1[0]\" /><br><br>";
	if ($row[5] == 1){
		echo "<input type=\"checkbox\" id=\"check5\" name=\"isReference5\" checked><label for=\"check5\">Check for Reference Item</label><br><br>";
	}	
	else{
		echo "<input type=\"checkbox\" id=\"check5\" name=\"isReference5\"><label for=\"check5\">Check for Reference Item</label><br><br>";
	}
		
	if($type == "Book"){
		echo "<label for=\"ISBN1\">ISBN: </label>";
		echo "<input type =\"text\" name=\"ISBN1\" id=\"ISBN1\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[1]\"/><br><br>";
		echo "<label for=\"authorName1\">Author: </label>";
		echo "<input type =\"text\" name=\"authorName1\" id=\"authorName1\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[0]\"/><br><br>";	
	}	
	else if($type == "Audio"){
		echo "<label for=\"artistName1\">Creator: </label>";
		echo "<input type =\"text\" name=\"artistName1\" id=\"artistName1\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[1]\"/><br><br>";
		echo "<label for=\"UPC3\">UPC: </label>";
		echo "<input type =\"text\" name=\"UPC3\" id=\"UPC3\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[3]\"/><br><br>";
		echo "<label for=\"producerName3\">Production Company: </label>";
		echo "<input type =\"text\" name=\"producerName3\" id=\"producerName3\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[2]\"/><br><br>";
	}	
	else if($type == "Video"){
		echo "<label for=\"UPC3\">UPC: </label>";
		echo "<input type =\"text\" name=\"UPC3\" id=\"UPC3\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[1]\"/><br><br>";
		echo "<label for=\"director2\">Director: </label>";
		echo "<input type =\"text\" name=\"director2\" id=\"director2\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[2]\"/><br><br>";
		echo "<label for=\"producerName3\">Production Company: </label>";
		echo "<input type =\"text\" name=\"producerName3\" id=\"producerName3\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[3]\"/><br><br>";

	}	
	else if($type == "Magazine"){
		echo "<label for=\"subName1\">Subtitle: </label>";
		echo "<input type =\"text\" name=\"subName1\" id=\"subName1\" class=\"text ui-widget-content ui-corner-all\"value=\"$row2[1]\" /><br><br>";
		echo "<p> Issue: <input type=\"text\" id=\"datepicker2\" name =\"datepicker2\" value=\"$row2[0]\"/></p>";
		echo "<label for=\"pubName4\">Publisher: </label>";
		echo "<input type =\"text\" name=\"pubName4\" id=\"pubName4\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[2]\"/><br><br>";
	}
	else if($type == "Newspaper"){
		echo "<p> Issue: <input type=\"text\" id=\"datepicker2\" name =\"datepicker2\" value=\"$row2[0]\"/></p>";
		echo "<label for=\"pubName4\">Publisher: </label>";
		echo "<input type =\"text\" name=\"pubName4\" id=\"pubName4\" class=\"text ui-widget-content ui-corner-all\" value=\"$row2[2]\"/><br><br>";
	}
	
	echo "<button type=\"submit\" name=\"submit\" value=\"Submit\">OK</button>";	
echo "</form>";
?>


