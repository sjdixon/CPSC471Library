<?php

/**
 * Created by Stephen Dixon
 */
 
 session_start();
        // If the user is not logged then the user will be set to
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }
 
include '../../Headers/dbConnect.php';

// Info
$username = mysql_real_escape_string($_POST['username']);
$authPass = md5(mysql_real_escape_string($_POST['authPass']));
$password = md5(mysql_real_escape_string($_POST['password']));
$repeat = md5(mysql_real_escape_string($_POST['repeat']));

// Check if legitimate change

$legitimate = FALSE;

$checkLoginQuery = "SELECT username, password from Librarian where username='$username' and password='$authPass'";
$checkLogin = mysql_query($checkLoginQuery);
$num = mysql_num_rows($checkLogin);
if (mysql_num_rows($checkLogin) == 1) {
    $legitimate = TRUE;
} else {
    $checkRootQuery = "SELECT username, password from Librarian where username='ubuntu' and password='$authPass'";
    $checkRoot = mysql_query($checkRootQuery);
    if (mysql_num_rows($checkRoot) == 1) {
        $legitimate = TRUE;
    }
}
echo "<br/>";
echo $legitimate ? 'true' : 'false';
echo "<br/>";

if ($legitimate == TRUE && $password == $repeat) {
    $query = "Update Librarian set password='$password' where username='$username'";
    $result = mysql_query($query);
    echo "$query <br/>";
    echo $result;
    if (!mysql_error()) print 'all is fine';
    header("Location: ../../librarian.php");
} else {
    header("Location: ../../Error/401.php");
}
exit();
?>
