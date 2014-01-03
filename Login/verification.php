<?php
session_start();
include '../Headers/dbConnect.php';
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim(mysql_real_escape_string($_POST['username']));
    $password = md5(trim(mysql_real_escape_string($_POST['password'])));
    $checklogin = mysql_query("SELECT * FROM Librarian WHERE username = '$username' AND password = '$password' and endDate is null");
    if (mysql_num_rows($checklogin) == 1) {
        $row = mysql_fetch_array($checklogin);
        $username = $row['username'];
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = 1;
        header('Location: ../App_Index.php'); //<-- comment it to see debug info
    } else {
        header("Location: loginInvalidInput.php");
    }
}
else {
	header("Location: loginInvalidInput.php");
}
exit();
?>