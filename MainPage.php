<!DOCTYPE html>
<html>
    <head>
        <!--Main page of our web application. Contains the tab framework and script files needed for the rest of the app-->
        <!--Gaby Comeau, November 22, 2013-->
        <title>Book-a-Book</title>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!--script type="text/javascript" src="jquery-1.10.2.min.js"></script-->
        <script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <link href="jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
        <!--Other CSS elements to style headers and links not included in the JQuery CSS page-->
        <style>
            h1 {font-family: Verdana,Arial,sans-serif; color: #1C94C4}
            a {font-family: Verdana,Arial,sans-serif;}
            div > div > table {border-collapse:collapse;}
            td {padding:3px 30px 3px 3px;}
            p {font-family: Verdana,Arial,sans-serif; color: #115B79}
            select {font-family: Verdana,Arial,sans-serif; color: #115B79}
        </style>
        <script>
            //Filters the table when a value is typed in.
            $(document).ready(function() {
                var $rows = $("#ItemsTable tbody>tr"), $cells = $rows.children();
                $("#searchString").keyup(function() {
                    var term = $(this).val()
                    //If the something has been entered into the text box, It will first hide all the rows
                    //Then if the value inside of a cell in one of the rows matches the entered term then those rows are displayed
                    //If nothing has been entered all of the rows in the table are appear
                    if (term != "") {
                        $rows.hide();
                        $cells.filter(function() {
                            return $(this).text().indexOf(term) > -1;
                        }).parent("tr").show();
                    } else {
                        $rows.show();
                    }
                });
            });
        </script>
    </head>

    <body>
        <a href="Login/Login.php">Login</a>
        <p>You can filter through our database by entering the title, genre, audience, year, or type of the item you wish to search for.</p>
        <p>All entered values must be must exactly match what you are looking for or it will not appear.</p>
        <input  type="text" id="searchString" name="searchString" size = "50"/>
        <?php
        include "./Headers/dbConnect.php";
        session_start();
        if (isset($_SESSION['loggedIn']))
            unset($_SESSION['loggedIn']);
        session_destroy();
        $itemList = mysql_query("Select * From Item");
        ?>
        <form>
            <table id="ItemsTable" class="ui-widget ui-widget-content">
                <thead>
                    <tr id="row" class="ui-widget-header ">
                        <th>Title</th>
                        <th>Type</th>
                        <th>Year</th>
                        <th>Shelf Location</th>
                        <th>Audience</th>
                        <th>Genre</th>
                        <th>Reference</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysql_fetch_assoc($itemList)) {
                        if ($row['isReference'] == 0) {
                            $ref = 'No';
                        } else {
                            $ref = 'Yes';
                        }

                        echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['itemType'] . "</td>";
                        echo "<td>" . $row['year'] . "</td>";
                        echo "<td>" . $row['shelfLoc'] . "</td>";
                        echo "<td>" . $row['audience'] . "</td>";
                        echo "<td>" . $row['genre'] . "</td>";
                        echo "<td>" . $ref . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </form>	
    </body>
</html>