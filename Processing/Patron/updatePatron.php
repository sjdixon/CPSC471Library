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
    $pId=$_POST['id'];
    $name=$_POST['name'];
    $addr=$_POST['addr'];
    $pNo=$_POST['phone'];
    $email=$_POST['email'];
    $query="Update Patron set name='$name', address='$addr', email='$email', phone='$pNo' Where pAccount='$pId'";
    
    $result=mysql_query($query);
    error_log(print_r($_REQUEST,true));

if($result){
    echo "Your comment has been sent";
}
else{
    echo "Error in sending your comment";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

    header("Location: ../../PatronInformation.php");
?> 
