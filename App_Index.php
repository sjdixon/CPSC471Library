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
            $(function() {
                $("#tabs").tabs();
                $("#dialog-return").dialog({
                    autoOpen: false,
                    height: 250,
                    width: 800,
                    modal: true,
                    buttons: {
                        "Return Item and Keep Window Open": function() {
                            $("form#returnForm").submit();
                        },
                        "Return Item and Close": function(){
                            $("form#returnForm").submit();
                            $(this).dialog("close");
                            
                        },
                        "Close Window": function() {
                            $(this).dialog("close");
                        }
                    }
                });
            $("#returnBtn").click(function(){
                $("#dialog-return").dialog("open");
            });
            });
        </script>
        
        <div id="dialog-return" title="Return Loaned Item" class="ui-widget">
            <form id="returnForm" method="post" action="Processing/Loans/returnItem.php">
                
                    <label for="returrnedLibraryCode"> Library Code: </label>
                    <input id="returnedLibraryCode" name="libraryCode"> <br/>
                    <label for="stock"> Stock# </label>
                    <input id="stocknum" name="stocknum" type="text"><br/>
                    
                    <label for="state">Action </label>
                    <select id="state" name="state">
                        <option value="OK"> Return Item</option>
                        <option value="Damaged"> Return & Mark as Damaged</option>
                        <option value="Discard"> Return & Mark as Discard</option>
                    </select>
            </form>
        </div>
    </head> 
    <body>
        <h1>Library Home</h1>
        <div id = "tabs">
            <ul>
                <li> <a href="catalogue.php">Catalog Search</a></li>
                <li> <a href="PatronTab.php">Patrons</a></li>
                <!--this tab is linked to a php script- this script therefore prints its' content in div tabs-3>-->
                <li> <a href="inventory.php">Inventory</a></li>
                <li> <a href="loanHold.php">Add Loans/Holds</a></li>
                <li> <a href="librarian.php">Librarian</a></li>
                <li> <a href="holdShelf.php">View Hold Shelf</a></li>
                <li> <a id="returnBtn" href="holdShelf.php"> Returns </a></li>
            </ul>
            <div id="tabs-1">
            </div>
            <div id="tabs-2">
            </div>
            <div id="tabs-3">
            </div>
            <div id ="tabs-4">
            </div>
            <div id ="tabs-5">
            </div>
        </div>
    </body>
</html>
