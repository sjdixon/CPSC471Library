<?php

   session_start();
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

   include '../../Headers/dbConnect.php';
        $date=  mysql_real_escape_string($_POST['radio']);
        //$rDate=  strtotime("y-m-d", $date);
        //$patronId=$_COOKIE['patronAccount'];
       foreach(mysql_real_escape_string($_POST['check']) as $num){
       $result=mysql_query("Update Loan Set dateDue='$date' where loanNum='$num'");
       error_log(print_r($_REQUEST,true));

if($result){
    echo "Success";
}
else{
    echo "Error in sending your user";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

  
       }
         header("Location: ../../PatronInformation.php");
        exit();
        
?>
