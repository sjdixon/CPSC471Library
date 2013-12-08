<!-- 
Librarian User Management Page
By: Stephen Dixon
-->

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Manage Librarians</title>
        <style>
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#users-contain { width: 350px; margin: 20px 0; }
            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }
        </style>
        <script>
            $(function() {
                $("#hold-dialog").dialog({
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
                $("#loan-dialog").dialog({
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
                $("#placeHold")
                        .button()
                        .click(function() {
                            $("#hold-dialog").dialog("open");
                        });
                $("#placeLoan")
                        .button()
                        .click(function() {
                            $("#loan-dialog").dialog("open");
                        });
            });
        </script>
    </head>

    <body>
        <div id="hold-dialog" name="AddHold">
            <p> Place a hold </p>
            <form id="holdForm" method="post" action="Processing/Loans/processHold.php">
                
            </form>
        </div>
        <div id="loan-dialog" name="AddLoan">
            <p> Place a Loan </p>
            <form id="loanForm" method="post" action="Processing/Loans/processLoan.php">
                
            </form>
        </div>
        
        <button  id="placeHold">Create Hold</button>
        <button  id="placeLoan">Create Hold</button>
    </body>
</html>
