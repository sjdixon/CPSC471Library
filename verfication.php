 <?php
        // Create connection
        $host = "MyPC";
	$user = "root";
	$pass = "root";				
	mysql_connect($host, $user, $pass) or die("Could not connect: " . mysql_error());
	mysql_select_db("library");
            $username=$_POST['username'];
            $password=$_POST['password'];
          $q=sprintf("SELECT LibrianId FROM Librarian WHERE username='%s' AND pass='%s'", mysql_real_escape_string($username), mysql_real_escape_string($password));
          $ifCorrect=mysql_query($q);
          
          if (! $ifCorrect) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $q;
    die($message);
}
          $count=0;
          while ($ifCorrect = mysql_fetch_assoc($ifCorrect)) {
	     $count++;
	}
	 
	if ($count == 1) {
            echo "Login Successfull";
	     header("Location: App_Index.php"); // This is wherever you want to redirect the user to
            }
        else {
             echo "Login not Successfull";
	     header("Location: Login.php"); // Wherever you want the user to go when they fail the login
            }
        ?>