<?php

    $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        $date=$_POST['radio'];
        //$rDate=  strtotime("y-m-d", $date);
        //$patronId=$_COOKIE['patronAccount'];
       foreach($_POST['check'] as $num){
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
         header("Location: ../PatronInformation.php");
        exit();
        
?>