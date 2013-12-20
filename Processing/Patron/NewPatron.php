<?php

include '../../Headers/checkAuth.php';
include '../../Headers/dbConnect.php';

$id = mysql_real_escape_string($_POST['pid']);
$name = mysql_real_escape_string($_POST['name']);
$email = mysql_real_escape_string($_POST['email']);
$address = mysql_real_escape_string($_POST['address']);
$phone = mysql_real_escape_string($_POST['phone']);
$u = mysql_query("SELECT * FROM PATRON WHERE pAccount='$id'");
$uni = mysql_fetch_row($u);
if ($uni > 0) {
    echo "The id you entered already exists.";
    print( '<a href="../../App_Index.php">Go back</a>');
} else {
    //Creates the expire date
    $expireDate = date('Y-m-d', strtotime("+365 day"));
    $q = "INSERT INTO Patron values ('$id', curdate(), '$expireDate' ,false, '$name', '$address', '$phone', '$email')";
    $result = mysql_query($q);
    error_log(print_r($_REQUEST, true));

    if ($result) {
        echo "Your comment has been sent";
    } else {
        echo "Error in sending your comment";
        echo "could not insert into Item table <br />";
        trigger_error(mysql_error(), E_USER_ERROR);
    }


    header("Location: ../../App_Index.php");
    exit();
}
?>
