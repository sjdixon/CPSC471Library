<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include '../../Headers/dbConnect.php';

// Collect information from form
$operationType = $_POST['radio'];
$patronIdType = $_POST['patronIdType'];
$patronId = $_POST['patronId'];
$itemCodeType = $_POST['itemCodeType'];
$itemCode = $_POST['itemCode'];
$query = "";

$libraryCode = "";
$pAccount = "";

// Obtain patronId if not given
if ($patronIdType != "pAccount") {
    $patronQuery = "SELECT pAccount from Patron where $patronIdType=$patronId";
    $result = mysql_query($patronQuery);
    $row = mysql_fetch_row($result);
    $pAccount = $row[0];
} else {
    $pAccount = $patronId;
}

// Check if patron is allowed to place holds or loans
$legal = TRUE;
$legalPatronQuery = "SELECT membershipExpiryDate, membershipExpired from Patron where pAccount=$pAccount and membershipExpiryDate < curdate()";
$patronExpired = mysql_query($legalPatronQuery);
$patronHasFines = "SELECT pAccount, balance from Fine where pAccount=$pAccount and balance > 0";
$fines = mysql_query($patronHasFines);
$patronExists = mysql_query("SELECT pAccount from Patron where pAccount=$pAccount");
if (mysql_num_rows($patronExpired) != 0) {
    $legal = FALSE;
    echo "Patron with id $pAccount has an expired account.";
}
if (mysql_num_rows($patronExists)==0){
    $legal = FALSE;
    echo "Patron with id $pAccount does not exist.";
}
if (mysql_num_rows($fines)!=0){
    $legal = FALSE;
    echo "Patron has fines.";
}


// Obtain the libraryCode of the book
if ($itemCodeType == "libraryCode") {
    $libraryCode = $itemCode;
} else if ($itemCodeType == "title") {
    $libraryCodeQuery = "SELECT libraryCode from Item where Title=$itemCode";
    $result = mysql_query($libraryCodeQuery);
    $row = mysql_fetch_row($result);
    $libraryCode = $row[0];
    echo "Retrieved libraryCode from select statement; title=$itemCode and libraryCode=$libraryCode";
}

echo "<br/> $operationType <br/>";
if ($legal == TRUE) {

    if ($operationType == "loan") {
        // Check if the copy is already loaned out.
        $stock = $_POST['stock'];
        $checkLoansQuery = "SELECT pAccount from Loan where libraryCode=$libraryCode and stocknum=$stock and returned is null";
        $duplicateLoans = mysql_query($checkLoansQuery);
        if (mysql_num_rows($duplicateLoans) != 0) {
            header("Location: ../../App_Index.php");
            exit();
        }

        //Check if there is a pre-existing hold on that copy of the book.
        $checkHoldsQuery = "SELECT pAccount, expiryDate from Hold where libraryCode=$libraryCode and stocknum=$stock" .
                " and expiryDate >= curdate() and pickupDate is NULL and availDate is not NULL ";
        $result = mysql_query($checkHoldsQuery);
        $row = mysql_fetch_row($result);
        $numRows = mysql_num_rows($result);
        if ($numRows == 0 || ($numRows > 0 && $row[0] == $pAccount)) {
            // Either no hold exists, or the patron who held it is loaning the item.
            $dueDate = $_POST['dueDate']; // if there is one
            $query = "INSERT INTO Loan values($pAccount,$stock,$libraryCode, now(),'$dueDate', NULL)";
            // Resolve the hold.
            $updateQuery = "UPDATE Hold set pickupDate=now() where libraryCode=$libraryCode and stocknum=$stock and pAccount=$pAccount and pickupDate is NULL";
            mysql_query($updateQuery);
        } else {
            // Do not loan - someone else has a hold on it.
            echo "Patron $libraryCode is trying to borrow a book that patron $row[0] has a hold on until $row[1].";
        }
    } else if ($operationType == "hold") {
        // Check if there is an unloaned copy
        $unloanedCopyQuery = "SELECT stocknum from Item_Instance as ii where ii.libraryCode=$libraryCode and " .
                "stocknum not in (SELECT stocknum from Loan as l where " .
                "l.libraryCode=ii.libraryCode and l.returned is null union ".
                "SELECT stocknum from Hold as h where h.libraryCode=ii.librarycode and pickupDate is NULL)";
        $result = mysql_query($unloanedCopyQuery);
        $availStock = mysql_fetch_row($result);
        $numResults = mysql_num_rows($result);
        $stocknum = "NULL";
        $timeToPickup = $_POST['timeToPickup'];
        if ($numResults > 0) {
            // If there is, place the instance on hold and set requestDate, dateHeld to curdate.
            $stocknum = $availStock[0];
            $dateAvail = "now()";
            $expiryDate = "NOW() + INTERVAL $timeToPickup";
            $query = "INSERT INTO Hold (pAccount, libraryCode, dateHeld, stocknum, availDate, expiryDate) " .
                    "values($pAccount, $libraryCode, now(), $stocknum, $dateAvail, $expiryDate)";
        } else {

            // If not, place the item on hold and set requestDate to curdate.
            $query = "INSERT INTO Hold (pAccount, libraryCode, dateHeld, timeToPickup) " .
                    "values($pAccount, $libraryCode, now(), '$timeToPickup')";
        }
    }

    echo "$query <br/>";
    $result = mysql_query($query);

    if (!$result) {
        echo $dueDate;
        echo "Error in sending your user";
        echo "could not insert into $operationType table <br />";
        error_log(print_r($_REQUEST, true));
        trigger_error(mysql_error(), E_USER_ERROR);
    } else {
        header("Location: ../../App_Index.php");
        exit();
    }
} else {
    echo "Patron $pAccount expired at time $row[0]";
}
?>

