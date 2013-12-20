<?php
$host = "localhost";
	include '../../Headers/dbConnect.php';
        foreach($_POST['lCode']as $item){
            
        $pId=$_COOKIE['patronAccount'];
        $itemId=$item;
        mysql_query("Delete From Hold where pAccount='$pId' and libraryCode='$itemId'");
       }
       header("Location: ../../PatronInformation.php");
        
?>
