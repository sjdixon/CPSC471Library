<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library") or die("Could not select database library");

$operationType = $_POST['radio'];
$patronIdType = $_POST['patronIdType'];
$patronId = $_POST['patronId'];
$itemCodeType = $_POST['itemCodeType'];
$itemCode = $_POST['itemCode'];
$query = "";

if (operationType == "loan") {

//Loan specific thingies

    $dueDate = $_POST['dueDate']; // if there is one
    $stock = $_POST['stock'];
    $query = "INSERT INTO Loan values($patronId,$stock,$itemCode, curdate(),'$dueDate', NULL)";
} else {
    // First, check if there is an unloaned copy
    // If there is, place the instance on hold and set requestDate, dateHeld to curdate.
    // If not, place the item on hold and set requestDate to curdate.
    $dateAvail = "NULL";
    $dateExpired = "NULL";
    $stocknum = "NULL";
    $query = "INSERT INTO Hold (pAccount, libraryCode, dateHeld) values($patronId, $itemCode, curdate())";
}

echo "$query<br/>";

$result = mysql_query($query);
error_log(print_r($_REQUEST, true));


if ($result) {
    echo "Success";
} else {
    echo $dueDate;
    echo "Error in sending your user";
    echo "could not insert into Item table <br />";
    trigger_error(mysql_error(), E_USER_ERROR);
}

header(" Location: ../../App_Index.php");
exit();
?>

