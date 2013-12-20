<?php

/**
 * Created by Stephen Dixon
 */
// If the user is not logged then the user will be set to
if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
    if ($_SESSION["loggedIn"] != 1) {
        header("Location: MainPage.php");
    }
} else {
    header("Location: MainPage.php");
}
?>