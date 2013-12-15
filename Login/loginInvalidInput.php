<!Done by Rhianne Hadfield> 
<!Display a the login page, but contains an alert to tell the user that they put in an invalid input>
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
            function errorAlert(){
                alert("You have entered an invalid Username or password. To login you must enter a valid Librarian Id as a username and the correct password");
            }
	</script>
</head> 
<body onload="errorAlert()">
   <form action='verification.php' method="post">
        <label for="username">Username: </label>
        <input type='number' name="username" id="username">
    
        <label for="password">Password: </label>
        <input type='password' name="password" id="password">

    <button type="submit" id="submit">Login</button>
    </form>
    <br>
    <a href="catalogue.php"><button>Go Back</button></a>
</body>
</html>