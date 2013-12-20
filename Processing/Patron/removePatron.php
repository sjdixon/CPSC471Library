<?php
    include '../../Headers/dbConnect.php';
       
        foreach ($_POST['pIds'] as $id) {
          
        $query="DELETE FROM Patron WHERE pAccount='$id'";
        mysql_query($query);
        }
        header("Location: ../../App_Index.php");
?>
