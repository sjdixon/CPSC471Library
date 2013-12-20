<?php

/**
 * Created by Stephen Dixon
 */
if (isset($_SESSION['loggedIn'])) {
    session_destroy();
}
header("Location: ../MainPage.php");
exit();
?>