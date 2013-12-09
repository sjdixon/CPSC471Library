<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library") or die("Could not select database library");

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
$legalPatronQuery = "SELECT membershipExpiryDate, membershipExpired from Patron where pAccount=$pAccount";
$result = mysql_query($legalPatronQuery);
$row = mysql_fetch_row($result);
$legal = TRUE;
$expiryDate = DateTime::createFromFormat('Y-m-d', $row[0])->format('Y-m-d');
if (expiryDate < date("Y-m-d")) {
    $legal = FALSE;
    echo "Patron with id $pAccount has an expired account.";
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

echo "$pAccount <br/> $operationType <br/>";
if ($legal == TRUE) {

    if ($operationType == "loan") {
        //Check conflicting loan
        
        // Create loan
        $dueDate = $_POST['dueDate']; // if there is one
        $stock = $_POST['stock'];
        $query = "INSERT INTO Loan values($pAccount,$stock,$libraryCode, curdate(),'$dueDate', NULL)";
    } else {
        // Check if there is an unloaned copy
        $unloanedCopyQuery = "SELECT stocknum from Item_Instance as ii where ii.libraryCode=$libraryCode and" .
                "stocknum not in (SELECT stocknum from Loan as l where" .
                "l.libraryCode=ii.libraryCode)";
        $result = mysql_query($unloanedCopyQuery);
        $availStock = mysql_fetch_row($result);
        $numResults = mysql_num_rows($result);
        $stocknum = "NULL";
        if ($numResults > 0) {
            // If there is, place the instance on hold and set requestDate, dateHeld to curdate.
            $stocknum = $availStock;
            $dateAvail = "curdate()";
            $dateExpired = date('Y-m-d', strtotime("+1 week"));
            $query = "INSERT INTO Hold (pAccount, libraryCode, dateHeld, stocknum, availDate, expiryDate)" .
                    "values($pAccount, $libraryCode, curdate(), $stocknum, $dateAvail, $expiryDate)";
        } else {

            // If not, place the item on hold and set requestDate to curdate.
            $query = "INSERT INTO Hold (pAccount, libraryCode, dateHeld)" .
                    "values($pAccount, $libraryCode, curdate())";
        }
    }


    echo $query;
    $result = mysql_query($query);


    if (!$result) {
        echo $dueDate;
        echo "Error in sending your user";
        echo "could not insert into Item table <br />";
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

