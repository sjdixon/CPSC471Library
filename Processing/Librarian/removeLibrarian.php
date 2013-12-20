<?php

/**
 * Created by Stephen Dixon
 */

session_start();
        // If the user is not logged then the user will be set to
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

// extract the index number
foreach ($_POST as $k=>$v) {
    if (substr($k, 0,8)==0){
        $id = substr($k,8);
        $queryText = "delete from Librarian where id=$id";
        $query = mysql_query($queryText);
        if (!$query){
            echo "Could not submit query. <br/>";
            echo $query;
            die();
        }
    }
    echo "Current value of $k: $v<br/>";
}

header("Location: ../../librarian.php");
exit();

?>
