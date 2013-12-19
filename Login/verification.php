<!Done by Rhianne Hadfield> 
<?php
        // Create connection
        $host = "localhost";
	$user = "ubuntu";
	$pass = "stephen123";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        
        $count=0;
          $username=$_POST['username'];
          $encriptedPassword=md5($_POST['password']);
          $eUser=md5($username);
          if($eUser===md5($user) && $encriptedPassword===md5($pass)){
          $count=1;}
          
           $verify=mysql_query("Select * From Librarian Where username='$username' and password='$encriptedPassword'");
           while($row=mysql_fetch_assoc($verify))
           {
             $count=1;  
           }
	if ($count == 1) {
            echo "Login Successfull";
	    header("Location: Add_Update_Fines.php"); 
            }
        else {
             echo "Login not Successfull";
	     header("Location: loginInvalidInput.php"); 
            }
        ?>
