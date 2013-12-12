
<!Done by Rhianne Hadfield> 
<?php
        // Create connection
        $host = "localhost";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
          $username=$_POST['username'];
          $password=$_POST['password'];
          if($password===$user){
              $q="SELECT count(*) FROM Librarian WHERE id='$username'";
              $ifCorrect=mysql_query($q);
              while($one=mysql_fetch_row($ifCorrect))
              {$count=$unique=$one[0]; }
	 
	if ($count == 1) {
            echo "Login Successfull";
	     header("Location: App_Index.php"); // This is wherever you want to redirect the user to
            }
        else {
             echo "Login not Successfull";
	     header("Location: Login.php"); // Wherever you want the user to go when they fail the login
            }
          }
          else{  header("Location: Login.php");} // Wherever you want the user to go when they fail the login 
        ?>