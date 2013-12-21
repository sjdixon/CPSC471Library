<?php

include '../../Headers/checkAuth.php';
include '../../Headers/dbConnect.php';
echo "Connected to library <br/>";
//$query = mysql_query("select * from Librarian where endDate is NULL") or die("Could not query");


// extract the index number
foreach ($_POST as $k=>$v) {
    $k = mysql_real_escape_string($k);
    $v = mysql_real_escape_string($v);
    if (substr($k, 0,8)==0){
        $id = substr($k,8);
        $queryText = "update Librarian set endDate=curdate() where id=$id";
        $query = mysql_query($queryText);
        if (!$query){
            echo "Could not submit query. <br/>";
            echo $query;
        }
    }
    echo "Current value of $k: $v<br/>";
}

header("Location: ../../App_Index.php");
exit();
?>
