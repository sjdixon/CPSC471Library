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
                        Create: function() {
                            $("form#operationForm").submit();
                            $(this).dialog("close");
                        },
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
                $("#dueDate").datepicker();

                $(".radioSelect").each(function() {
                    showSpecificFields(this);
                });
                $(".radioSelect").click(function() {
                    showSpecificFields(this);
                });

                function showSpecificFields(obj) {
                    if ($(obj).is(":checked")) {
                        var radioVal = $(obj).attr('id');
                        $(".fieldSpecific").each(function() {
                            if ($(this).attr('name') == radioVal) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    }
                }



            });
        </script>
    </head>

    <body>

        <br/>


        <div id="operation" name="Dialog" class="ui-widget">
            <form id="operationForm" method="post" action="Processing/Loans/process.php">

                <div id="radio" class="ui-widget">
                    <input type="radio" id="loan" name="radio" checked="checked" class="radioSelect" value="loan"><label for="loan">Loan </label>
                    <input type="radio" id="hold" name="radio" class="radioSelect" value="hold"><label for="hold">Hold</label>
                </div><br/>
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
                        <option value="libraryItem">Title and/or Author</option>
                    </select>
                    <label for="itemCode"> : </label><input id="itemCode"> 
                    <label for="stocknum" class="fieldSpecific" name="loan"> Stock# </label>
                    <input id="stockNum" name="loan" class="fieldSpecific" type="text">
                </div> 
                
                <br/>

                <div id="date" class="ui-widget fieldSpecific" name="loan">
                    <label for="dueDate">Due Date: </label>
                    <input type="text" id="dueDate">
                </div>

                <div id="timeToPickup" class="ui-widget fieldSpecific" name="hold">
                    <label for="timeToPickup">Time to Pickup: </label>
                    <select id="timeToPickup">
                        <option value="One Week">One Week</option>
                        <option value="Two Weeks">Two Weeks</option>
                        <option value="Three Weeks">Three Weeks</option>
                    </select>
                </div>
                <br/>
                <br/>
            </form>
        </div>


        <div id="dialog-confirm" title="Are you sure?">
            <p class="fieldSpecific" name="loan">
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Are you sure you want to make a <strong>loan</strong> with that info?
            </p>

            <p class="fieldSpecific" name="hold">
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Are you sure you want to make a <strong>hold</strong> with that info?  
            </p>
        </div>

        <button  id="submitBtn">
            <p class="fieldSpecific" name="loan">Create Loan</p>
            <p class="fieldSpecific" name="hold">Create Hold</p>
        </button>
    </body>
</html>
