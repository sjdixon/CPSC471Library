<?php
mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library");
echo "Connected to library <br/>";
$query = mysql_query("select * from Librarian where endDate is NULL") or die("Could not query");

echo "POSTED:  $_POST <br/>";

// extract the index number
foreach ($_POST as $k=>$v) {
    if (substr($k, 0,8)==0){
        $id = substr($k,8);
        $query = mysql_query("update Librarian set endDate=curdate() where id=".$id);
        if (!$query){
            echo "Could not submit query.";
        }
    }
    echo "Current value of $k: $v<br/>";
}

header("Location: ../../App_Index.php");
exit();
?>