
<!Done by Rhianne Hadfield> 
<?php
        // Create connection
        $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
        
        $count=0;
          $username=$_POST['username'];
          $password=$_POST['password'];
          if($username===$user && $password===$pass){
          $count=1;}
          if($username==="stephen" && $password==="abc123"){
          $count=1;}
          if($username==="admin" && $password==="letmein"){
          $count=1;}
          if($username==="ubuntu" && $password==="stephen123"){
          $count=1;}
           $verify=mysql_query("Select * From Librarian Where username='$username'");
           while(mysql_fetch_assoc($verify))
           {
               if($password==='ubuntu')
               {
                   $count=1;
               }
           }
	if ($count == 1) {
            echo "Login Successfull";
	     header("Location: ../App_Index.php"); // This is wherever you want to redirect the user to
            }
        else {
             echo "Login not Successfull";
	     header("Location: loginInvalidInput.php"); // Wherever you want the user to go when they fail the login
            }
        ?>