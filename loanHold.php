<!-- 
Librarian User Management Page
By: Stephen Dixon
-->

<?php session_start();
        // If the user is not logged then the user will be set to the main page
        if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
          if($_SESSION["loggedIn"] !=1)
          {
              header("Location: MainPage.php");
          }
        }
        else{
            header("Location: MainPage.php");
        }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add Loans and Holds</title>
        <script>
            $(function() {

                $("#dialog-operationConfirm").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        Create: function() {
                            $("form#operationForm2").submit();
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
                            $("#dialog-operationConfirm").dialog("open");
                        });


                $("#radio").buttonset();
                $("#dueDate").datepicker({
				changeMonth: true,
				changeYear: true
			}).bind("keydown", function (event) {
    		event.preventDefault();
			});

                $(".radioSelect").each(function() {
                    showSpecificFields(this);
                });
                $(".radioSelect").click(function() {
                    showSpecificFields(this);
                });

                function showSpecificFields(obj) {
                    if ($(obj).is(":checked")) {
                        var radioVal = $(obj).attr('id');
                        if (radioVal === "loan") {
                            $(".loanOnly").each(function() {
                                $(this).show();
                            });
                            $(".holdOnly").each(function() {
                                $(this).hide();
                            });
                        }
                        else if (radioVal === "hold") {
                            $(".loanOnly").each(function() {
                                $(this).hide();
                            });
                            $(".holdOnly").each(function() {
                                $(this).show();
                            });
                        }
                    }
                }



            });
        </script>
    </head>

    <body>

        <br/>


        <div id="operation2" name="Dialog" class="ui-widget">
            <form id="operationForm2" method="post" action="Processing/Loans/process.php">

                <div id="loanHoldRadio" class="ui-widget">
                    <input type="radio" id="loan" name="radio" checked="checked" class="radioSelect" value="loan"><label for="loan">Loan </label>
                    <input type="radio" id="hold" name="radio" class="radioSelect" value="hold"><label for="hold">Hold</label>
                </div><br/>
                <div class="ui-widget">
                    <select id="patronIdType" name="patronIdType">
                        <option value="pAccount">Library Account Number</option>
                    </select>
                    <label for="patronId" > : </label>
                    <input type="text" id="patronId" name="patronId">
                </div> <br/>
                <div class="ui-widget">
                    <select id="itemCodeType" name="itemCodeType">
                        <option value="libraryCode">Library Code</option>
                    </select>
                    <label for="itemCode"> : </label>
                    <input id="itemCode" name="itemCode"> 
                    <label for="stock" class="loanOnly"> Stock# </label>
                    <input id="stock" name="stock" class="loanOnly" type="text">
                </div> <br/>

                <div id="date" class="ui-widget loanOnly">
                    <label for="dueDate">Due Date: </label>
                    <input type="text" id="dueDate" name="dueDate">
                </div>

                <div id="timeToPickup" class="ui-widget holdOnly">
                    <label for="timeToPickup">Time to Pickup: </label>
                    <select id="timeToPickup" name="timeToPickup">
                        <option value="1 week">One Week</option>
                        <option value="2 week">Two Weeks</option>
                        <option value="3 week">Three Weeks</option>
                        <option value="1 day">One Day</option>
                        <option value="3 day">Three Days</option>
                    </select>
                </div>
                <br/>
                <br/>
            </form>
        </div>


        <div id="dialog-operationConfirm" title="Are you sure?">
            <p class="loanOnly">
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Are you sure you want to make a <strong>loan</strong> with that info?
            </p>

            <p class="holdOnly" >
                <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                Are you sure you want to make a <strong>hold</strong> with that info?  
            </p>
        </div>


        <button  id="submitBtn">
            <p class="loanOnly" name="loan">Create Loan</p>
            <p class="holdOnly" name="hold">Create Hold</p>
        </button>
    </body>
</html>
