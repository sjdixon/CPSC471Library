<?php
$host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        foreach($_POST['lCode']as $item){
            
        $pId=$_COOKIE['patronAccount'];
        $itemId=$item;
        mysql_query("Delete From Hold where pAccount='$pId' and libraryCode='$itemId'");
       }
       header("Location: PatronInformation.php");
        
?>