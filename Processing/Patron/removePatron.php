<?php
    $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";			
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
       
        foreach ($_POST['pIds'] as $id) {
          
        $query="DELETE FROM Patron WHERE pAccount='$id'";
        mysql_query($query);
        }
        header("Location: ../../PatronTab.php");
?>
