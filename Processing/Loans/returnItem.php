<?php

/**
 * Created by Stephen Dixon
 */
mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library") or die("Could not select database library");

// Get Form Info

$libraryCode = $_POST['libraryCode'];
$stocknum = $_POST['stocknum'];
$state = $_POST['state'];

$updateLoans = "Update Loan set returned=curdate() where libraryCode=$libraryCode and stocknum=$stocknum";
$result2 = mysql_query($updateLoans);
echo "$updateLoans <br/>";


$updateState = "Update Item_Instance set state='$state' where libraryCode=$libraryCode and stocknum=$stocknum";
$result = mysql_query($updateState);
echo "$updateState <br/>";
if ($result) {
    header("Location: ../../App_Index.php");
    exit();
}
?>