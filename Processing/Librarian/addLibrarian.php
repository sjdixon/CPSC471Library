<?php


include '../../Headers/checkAuth.php';
include '../../Headers/dbConnect.php';

$name = mysql_real_escape_string($_POST['name']);
$username = mysql_real_escape_string($_POST['username']);
$numIds = mysql_query("SELECT MAX(l.id) from Librarian l");
$currentId = mysql_fetch_row($numIds);
$id = $currentId[0] + 1;
$password = mysql_real_escape_string($_POST['password']);
$password = md5($password);
$query = "INSERT INTO Librarian values ($id,'$name', now(), NULL, '$username', '$password')";
$result = mysql_query($query);
error_log(print_r($_REQUEST, true));

if ($result) {
    echo "Success";
} else {
    echo "Error in sending your user <br/>";
    echo "could not insert into Librarian table <br />";
    echo "$query";
    trigger_error(mysql_error(), E_USER_ERROR);
}

header("Location: ../../App_Index.php");
exit();
?>
