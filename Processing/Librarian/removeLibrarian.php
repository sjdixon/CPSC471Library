<?php

/**
 * Created by Stephen Dixon
 */

mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library");
echo "Connected to library <br/>";

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
