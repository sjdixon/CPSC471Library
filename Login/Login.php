<!Done by Rhianne>
<!DOCTYPE html>
<html>
    <head>
        <!--Main page of our web application. Contains the tab framework and script files needed for the rest of the app-->
        <!--Gaby Comeau, November 22, 2013-->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!--script type="text/javascript" src="jquery-1.10.2.min.js"></script-->
        <script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <link href="jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
    </head> 
    <body>
        <div class="ui-widget">
            <form action="verification.php" method="post">
                <label for="username">Username: </label>
                <input type='number' name="username" id="username">

                <label for="password">Password: </label>
                <input type='password' name="password" id="id">

                <button type="submit" id="submit">Login</button>
            </form>
            <br>
        <button onclick="location.href='../MainPage.php'">Go Back</button>
        </div>
    </body>
</html>
