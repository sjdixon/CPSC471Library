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


// End current loan
$updateLoans = "Update Loan set returned=curdate() where libraryCode=$libraryCode and stocknum=$stocknum";
$result2 = mysql_query($updateLoans);
echo "$updateLoans <br/>";

// Update item state
$updateState = "Update Item_Instance set state='$state' where libraryCode=$libraryCode and stocknum=$stocknum";
$result = mysql_query($updateState);
echo "$updateState <br/>";

// Assign to next hold
$isRelevant = "availDate is null and libraryCode=$libraryCode";
$minDate = "Select min(dateHeld) from Hold as h2 where h2.availDate is null and h2.libraryCode=$libraryCode";
$minDateResult = mysql_query($minDate);
$row = mysql_fetch_row($minDateResult);

$updateHolds = "Update Hold set availDate=curdate() where $isRelevant and dateHeld=$row[0]";
$result = mysql_query($updateHolds);
echo "$updateHolds <br/>";
?>