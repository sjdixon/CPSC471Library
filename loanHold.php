<!-- 
Librarian User Management Page
By: Stephen Dixon
-->

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add Loans and Holds</title>
        <script>
            $(function() {
                $("#dialog-confirm").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        Close: function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#submitBtn")
                        .button()
                        .click(function() {
                            $("#dialog-confirm").dialog("open");
                        });
                $("#radio").buttonset();
            });
        </script>
    </head>

    <body>

<br/>
<br/>


        <div id="operation" name="Dialog" class="ui-widget">
            <form id="form" method="post" action="Processing/Loans/process.php">
                <div class="ui-widget">
                    <select id="patronIdType">
                        <option value="Account">Library Account Number</option>
                        <option value="Name">Patron Name</option>
                        <option value="Phone Number">Phone Number</option>
                    </select>
                    <label for="patronId" > : </label><input type="text" id="patronId">
                </div> <br/>
                <div class="ui-widget">
                    <select id="itemCodeType">
                        <option value="libraryCode">Library Code</option>
                        <option value="titleAndAuthor">Title and/or Author</option>
                    </select>
                    <label for="itemCode"> : </label><input id="itemCode"> 
                </div> <br/>
                <div id="radio">
                    <input type="radio" id="loan" name="radio" checked="checked"><label for="loan">Loan </label>
                    <input type="radio" id="hold" name="radio"><label for="hold">Hold</label>
                </div>
            </form>
        </div>


        <div id="dialog-confirm" title="Empty the recycle bin?">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
        </div>

        <button  id="submitBtn">Create Hold/Loan</button>
    </body>
</html>
