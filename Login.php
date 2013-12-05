<!Done by Rhianne>
<!DOCTYPE html>
<html>
<head>
	<!--Main page of our web application. Contains the tab framework and script files needed for the rest of the app-->
	<!--Gaby Comeau, November 22, 2013-->
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<link href="jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
	<!--Other CSS elements to style headers and links not included in the JQuery CSS page-->
	
    
	<script>
	function submit() {
        <?php
        // Create connection
        $con=mysqli_connect("ec2-54-201-32-111.us-west-2.compute.amazonaws.com","ubuntu","stephen123","my_db");

        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $ifCorrect=mysqli_query($con, "SELECT LibrianId FROM Librarian WHERE username='$_POST[username]' AND pass='$_POST[password]'");
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
        }
	</script>
</head> 
<body>
    <div id="username">
        <label for="username">Username: </label>
        <input type='text' id="username">
    </div>
    
    <div id="Password">
        <label for="password">Password: </label>
        <input type='password' id="password">
    </div>
    <div>
    <button type="submit" onclick="submit()" id="submit">Login</button></a>
    </div>
</body>
</html>