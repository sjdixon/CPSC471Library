<?php

        $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        $date=$_POST['rDate'];
        $patronId=$_COOKIE['patronAccount'];
       foreach($_POST['info'] as $infoStr)
       {
       echo $date;
       $info=explode(",", $infoStr);
       $itemCode=intval($info[0]);
       echo $itemCode;
       $stocknum=intval($info[1]);
       echo $stocknum;
       $result=mysql_query("Update Loan Set dateDue='$date' where pAccount='$patronId' and libraryCode='$itemCode' and stocknum='$stocknum'");
       //error_log(print_r($_REQUEST,true));
/*
if($result){
    echo "Your comment has been sent";
}
else{
    echo "Error in sending your comment";
      	echo "could not insert into Item table <br />";
    	trigger_error(mysql_error(), E_USER_ERROR);
}

       */
       }
        
        
?>