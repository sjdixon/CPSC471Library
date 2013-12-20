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
    if (substr($k, 0,8) == "checkbox"){
        $info = explode('-',$k);
        $id = $info[1];
        $code = $info[2];
        $stock = $info[3];
        $queryText = "update Hold set removalDate=now() where pAccount=$id and shelfDate is not null and removalDate is null and libraryCode=$code and stocknum=$stock";
        $query = mysql_query($queryText);
        if (!$query){
            echo "Could not submit query. <br/>";
            echo "$queryText <br/>";
            echo "$k<br/>";
            echo "$info[0]<br/>";
            echo "$info[1]<br/>";
            echo "$info[2]<br/>";
            echo "$info[3]<br/>";
            die();
        }
    }
    echo "Current value of $k: $v<br/>";
}

header("Location: ../../App_Index.php");
exit();

?>
