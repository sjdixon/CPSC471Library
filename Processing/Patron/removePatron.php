<?php

include '../../Headers/checkAuth.php';
include '../../Headers/dbConnect.php';

// extract the index number
foreach ($_POST as $k=>$v) {
    if (substr($k, 0,8) == "checkbox"){
        $info = explode('-',$k);
        $id = $info[1];
        $queryText = "delete from Patron where pAccount=$id";
        $query = mysql_query($queryText);
        if (!$query){
            echo "Could not submit query. <br/>";
            echo "$queryText <br/>";
            echo "$k<br/>";
            echo "$info[0]<br/>";
            echo "$info[1]<br/>";
            die();
        }
    }
    echo "Current value of $k: $v<br/>";
}
header("Location: ../../App_Index.php");
?>
