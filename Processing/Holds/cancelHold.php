<?php

/**
 * Created by Stephen Dixon
 */


include '../../Headers/checkAuth.php';
include '../../Headers/dbConnect.php';
echo "Connected to library <br/>";

// extract the index number
foreach ($_POST as $k=>$v) {
    $k = mysql_real_escape_string($k);
    $v = mysql_real_escape_string($v);
    if (substr($k, 0,8) == "checkbox"){
        $info = explode('-',$k);
        $id = $info[1];
        $code = $info[2];
        $stock = $info[3];
        $queryText = "delete from Hold where pAccount=$id and libraryCode=$code and stocknum=$stock and pickupDate is null";
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

header("Location: ../../PatronInformation.php");
exit();

?>