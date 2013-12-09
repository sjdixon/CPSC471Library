<?php
        $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
       
        foreach ($_POST['pIds'] as $id) {
          
           $query="DELETE FROM Patron WHERE pAccount='$id'";
        $result = mysql_query($query);
        error_log(print_r($_REQUEST,true));

        if($result){
            echo "Your comment has been sent";
        }
        else{
            echo "Error in sending your comment";
                echo "could not insert into Item table <br />";
                trigger_error(mysql_error(), E_USER_ERROR);
        }

            
        }
?>
