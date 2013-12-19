<?php

/**
 * Created by Stephen Dixon
 */


mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library");
echo "Connected to library <br/>";

// extract the index number
foreach ($_POST as $k=>$v) {
    if (substr($k, 0,8) == "checkbox"){
        $info = explode('-',$k);
        $id = $info[1];
        $code = $info[2];
        $stock = $info[3];
        $queryText = "update Hold set shelfDate=curdate() where pAccount=$id and shelfDate is null and availDate is not null and libraryCode=$code and stocknum=$stock";
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

header("Location: ../../holdShelf.php");
exit();
?>