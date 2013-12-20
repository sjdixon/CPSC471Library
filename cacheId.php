<!Create by Rhianne Hadfield>

<?php session_start();
        // If the user is not logged then the user will be set to the main page
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }


$patronId=$_POST['pAccount'];
setcookie('patronAccount', $patronId, time()+1800);
header("Location: PatronInformation.php");

?>
