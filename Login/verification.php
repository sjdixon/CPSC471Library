<!Done by Rhianne Hadfield> 
<?php
// Created by Rhianne Hadfield
// Modified by Stephen Dixon

include '../Headers/dbConnect.php';



if (!empty($_POST['username']) && !empty($_POST['password'])) {
    echo "You entered: username={$_POST['username']}, password={$_POST['password']}<br>";
    $username = mysql_real_escape_string(trim($_POST['username']));
    $password = md5(mysql_real_escape_string(trim($_POST['password'])));

    echo "Your username after escaping: {$username}<br>";
    echo "Your password after scaping and MD5: {$password}<br>";

    $checklogin = mysql_query("SELECT * FROM Librarian WHERE username = '$username' AND password = '$password' and endDate is null");


    if (mysql_num_rows($checklogin) == 1) {
        $row = mysql_fetch_array($checklogin);
        $username = $row['username'];
        $email = $row['email'];
        $name = $row['name'];
        $surname = $row['surname'];

        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = 1;
        echo "Success!";
        header('Location: Add_Update_Fines.php'); //<-- comment it to see debug info
    } else {
        echo "Not successful.";
        header("Location: loginInvalidInput.php");
    }
}
else {
	echo "Not successful.";
	header("Location: loginInvalidInput.php");
}
exit();
?>