<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

mysql_connect("localhost", "ubuntu", "stephen123") or die("Could not connect: " . mysql_error());
mysql_select_db("library") or die("Could not select database library");

$patronIdType = $_POST['patronIdType'];
$patronId = $_POST['patronId'];

$itemCodeType = $_POST['itemCodeType'];
$itemCode = $_POST['itemCode'];

//Loan specific thingies

$dueDate = $_POST['dueDate']; // if there is one
$stock = $_POST['stock'];
$query = "INSERT INTO Loan values($patronId,$stock,$itemCode, curdate(),'$dueDate', NULL)";


echo "'$query'";
echo "'$patronIdType'<br/>";
echo "'$patronId'<br/>";
echo "'$itemCodeType'<br/>";
echo "'$itemCode'<br/>";
echo "'$dueDate'<br/>";
        
$result = mysql_query($query);
error_log(print_r($_REQUEST,true));


if($result){
    echo "Success";
}
else{
    echo $dueDate;
    echo "Error in sending your user";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

header("Location: ../../App_Index.php");
exit();
?>

