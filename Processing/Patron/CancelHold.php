<?php
$host = "localhost";
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

	include '../../Headers/dbConnect.php';
        foreach($_POST['lCode']as $item){
            
        $pId=$_COOKIE['patronAccount'];
        $itemId=$item;
        mysql_query("Delete From Hold where pAccount='$pId' and libraryCode='$itemId'");
       }
       header("Location: ../../PatronInformation.php");
        
?>
