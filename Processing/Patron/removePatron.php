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

    include '../../Headers/dbConnect.php';
       
        foreach ($_POST['pIds'] as $id) {
          
        $query="DELETE FROM Patron WHERE pAccount='$id'";
        mysql_query($query);
        }
        header("Location: ../../App_Index.php");
?>
