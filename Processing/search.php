<?php
	//search.php - written by Gaby Comeau
	//Function to implement the search results div
	$host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");	
	$type = mysql_real_escape_string($_GET['type']);
	$string = mysql_real_escape_string($_GET['string']);
	$sType = mysql_real_escape_string($_GET['sType']);
	
	if($string==''){
			echo "<p>Error: No search string specified</p>";
	}
	else if($sType==''){
			echo "<p>Error: No search category specified</p>";
	}
	 
	else if($sType== "Title"){
		$result = mysql_query("SELECT * FROM ITEM WHERE title='$string'");
		echo "<table border=\"1\">";
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Library Code</th>";
				echo "<th>Genre</th>";
				echo "<th>Audience</th>";
				echo "<th>Location</th>";
			echo "</tr>";
		while ($row=mysql_fetch_array($result)){
			echo '<tr>';
				echo "<td>".$row['title']."</td>";
				echo "<td>".$row['libraryCode']."</td>";
				echo "<td>".$row['genre']."</td>";
				echo "<td>".$row['audience']."</td>";
				echo "<td>".$row['shelfLoc']."</td>";
			echo '</tr>';
		}
		echo "</table>";
		
		mysql_free_result($result);	
	}
	
	else if($sType == "Genre"){
		$result = mysql_query("SELECT * FROM ITEM WHERE genre='$string'");
		echo "<table border=\"1\">";
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Library Code</th>";
				echo "<th>Genre</th>";
				echo "<th>Audience</th>";
				echo "<th>Location</th>";
			echo "</tr>";
		while ($row=mysql_fetch_array($result)){
			echo '<tr>';
				echo "<td>".$row['title']."</td>";
				echo "<td>".$row['libraryCode']."</td>";
				echo "<td>".$row['genre']."</td>";
				echo "<td>".$row['audience']."</td>";
				echo "<td>".$row['shelfLoc']."</td>";
			echo '</tr>';
		}
		echo "</table>";
		
		mysql_free_result($result);	
	}
	
	else if($sType == "year"){
		$result = mysql_query("SELECT * FROM ITEM WHERE year='$string'");
		echo "<table border=\"1\">";
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Library Code</th>";
				echo "<th>Genre</th>";
				echo "<th>Audience</th>";
				echo "<th>Location</th>";
			echo "</tr>";
		while ($row=mysql_fetch_array($result)){
			echo '<tr>';
				echo "<td>".$row['title']."</td>";
				echo "<td>".$row['libraryCode']."</td>";
				echo "<td>".$row['genre']."</td>";
				echo "<td>".$row['audience']."</td>";
				echo "<td>".$row['shelfLoc']."</td>";
			echo '</tr>';
		}
		echo "</table>";
		
		mysql_free_result($result);	
	}
	
	else if($sType == "libraryId"){
		$result = mysql_query("SELECT * FROM ITEM WHERE libraryCode='$string'");	
		echo "<table border=\"1\">";
			echo "<tr>";
				echo "<th>Title</th>";
				echo "<th>Library Code</th>";
				echo "<th>Genre</th>";
				echo "<th>Audience</th>";
				echo "<th>Location</th>";
			echo "</tr>";
		while ($row=mysql_fetch_array($result)){
			echo '<tr>';
				echo "<td>".$row['title']."</td>";
				echo "<td>".$row['libraryCode']."</td>";
				echo "<td>".$row['genre']."</td>";
				echo "<td>".$row['audience']."</td>";
				echo "<td>".$row['shelfLoc']."</td>";
			echo '</tr>';
		}
		echo "</table>";
		
		mysql_free_result($result);	
	}
	
?>	