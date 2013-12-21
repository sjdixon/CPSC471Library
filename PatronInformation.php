<!-- Done by Rhianne -->
<!DOCTYPE html>
<?php
// Start up your PHP Session 

session_start();
// If the user is not logged then the user will be set to 
if (isset($_SESSION['loggedIn']) && isset($_SESSION['username'])) {
    if ($_SESSION["loggedIn"] != 1) {
        header("Location: MainPage.php");
    }
} else {
    header("Location: MainPage.php");
}
?>
<html>
    <head>
        <!--Main page of our web application. Contains the tab framework and script files needed for the rest of the app-->
        <!--Gaby Comeau, November 22, 2013-->
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <link href="jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
        <!--Other CSS elements to style headers and links not included in the JQuery CSS page-->

        <style>
            body { font-size: 62.5%; }
            label, input { display:block; }
            input.text { margin-bottom:12px; width:100%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#Info_table { width: 400px; margin: 20px 0; }
            div#Info_table table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#Info_table table td, div#Info_table table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }
        </style>


        <script>
            $(function() {
                $("#accordion").accordion({
                    collapsible: true
                });
            });
            //Dialog method used for renewing loans
            $(function() {
                $("#dialog-form1").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Renew Item": function() {
                            $("form#RenewItemForm").submit();
                            $(this).dialog("close");
                        },
                        Cancel: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        allFields.val("").removeClass("ui-state-error");
                    }
                });
                $("#renew")
                        .button()
                        .click(function() {
                            $("#dialog-form1").dialog("open");
                        });
            });

            //Hold dialog Function
            $(function() {
                $("#RemoveHold").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Remove Hold": function() {
                            $("form#cancelHoldForm").submit();
                            //Since the page is not refreshed after using Ajax, this deletes checked rows from the html table  
                            holdTable = document.getElementById('Holds');
                            selected = document.getElementsByName('check[]');
                            for (i = selected.length - 1; i >= 0; i--)
                            {
                                if (selected[i].checked === true) {
                                    holdTable.deleteRow(i + 1)
                                }
                            }
                            $(this).dialog("close");
                        },
                        Cancel: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        allFields.val("").removeClass("ui-state-error");
                    }
                });
                $("#Cancel")
                        .button()
                        .click(function() {
                            $("#RemoveHold").dialog("open");
                        });
            });
            //Fines Pay page
            $(function() {
                var waive = $("#waive"),
                        payment = $("#payment"),
                        Handled = $("#Handled");
                allFields = $([]).add(waive).add(payment).add(Handled),
                        tips = $(".validateTips");
                function updateTips(t) {
                    tips
                            .text(t)
                            .addClass("ui-state-highlight");
                    setTimeout(function() {
                        tips.removeClass("ui-state-highlight", 1500);
                    }, 500);
                }
                function checkLength(o, n, min, max) {
                    if (o.val().length > max || o.val().length < min) {
                        o.addClass("ui-state-error");
                        updateTips("Length of " + n + " must be between " +
                                min + " and " + max + ".");
                        return false;
                    } else {
                        return true;
                    }
                }
                function checkRegexp(o, regexp, n) {
                    if (!(regexp.test(o.val()))) {
                        o.addClass("ui-state-error");
                        updateTips(n);
                        return false;
                    } else {
                        return true;
                    }
                }
                $("#dialog-formPay").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Pay/Waiver Fines": function() {
                            var bValid = true;
                            allFields.removeClass("ui-state-error");
                            bValid = bValid && checkLength(waive, "Waive", 1, 3);
                            bValid = bValid && checkLength(payment, "Payment", 1, 3);
                            bValid = bValid && checkLength(Handled, "Handled By", 1, 45);

                            bValid = bValid && checkRegexp(waive, /^([0-9])+$/, "You may only enter a number");
                            bValid = bValid && checkRegexp(payment, /^([0-9])+$/, "You may only enter a number");

                            if (bValid) {
                                //This section transfers the values in entered in the dialog form to the modal confirmation dialog box, before opening the modal confirmation dialog box.
                                var waiveString = String(waive.val());
                                waiveString = "Waive: $".concat(waiveString.toString());
                                var payString = String(payment.val());
                                payString = "Pay: $".concat(payString.toString());
                                var handleString = String(Handled.val());
                                handleString = "Handled By: ".concat(handleString.toString());
                                document.getElementById('waiveC').innerHTML = waiveString;
                                document.getElementById('payC').innerHTML = payString;
                                document.getElementById('HandledByC').innerHTML = handleString;
                                document.getElementById('patronC').innerHTML = "Patron: " +<?php echo $_COOKIE["patronAccount"] ?>;

                                $("#dialog-formConfirm").dialog("open");
                                $(this).dialog("close");
                            }
                        },
                        Cancel: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        allFields.val("").removeClass("ui-state-error");
                    }
                });
                $(function() {
                    $("#dialog-formConfirm").dialog({
                        autoOpen: false,
                        height: 300,
                        width: 350,
                        modal: true,
                        buttons: {
                            "Ok": function() {
                                $("form#FineConfirm").submit();
                                $(this).dialog("close");

                            },
                            "Go Back": function() {
                                $("#dialog-formPay").dialog("open");
                                $(this).dialog("close");
                            }
                        },
                        close: function() {
                            allFields.val("").removeClass("ui-state-error");
                        }
                    });
                    $("#payWaiverFines")
                            .button()
                            .click(function() {
                                $("#dialog-formPay").dialog("open");
                            });
                });
            });

            //edit patron
            $(function() {
                var name = $("#name"),
                        email = $("#email"),
                        address = $("#addr"),
                        phone = $("#phone");
                allFields = $([]).add(name).add(email).add(address).add(phone).add(id),
                        tips = $(".validateTips");
                function updateTips(t) {
                    tips
                            .text(t)
                            .addClass("ui-state-highlight");
                    setTimeout(function() {
                        tips.removeClass("ui-state-highlight", 1500);
                    }, 500);
                }
//This function checks the length of the string
                function checkLength(o, n, min, max) {
                    if (o.val().length > max || o.val().length < min) {
                        o.addClass("ui-state-error");
                        updateTips("Length of " + n + " must be between " +
                                min + " and " + max + ".");
                        return false;
                    } else {
                        return true;
                    }
                }
                function checkRegexp(o, regexp, n) {
                    if (!(regexp.test(o.val()))) {
                        o.addClass("ui-state-error");
                        updateTips(n);
                        return false;
                    } else {
                        return true;
                    }
                }
                $("#dialogEdit").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Create an account": function() {

                            var bValid = true;
                            allFields.removeClass("ui-state-error");
                            bValid = bValid && checkLength(name, "name", 1, 50);
                            bValid = bValid && checkLength(email, "email", 1, 50);
                            bValid = bValid && checkLength(address, "address", 1, 45);
                            bValid = bValid && checkLength(phone, "phone", 10, 10);


                            bValid = bValid && checkRegexp(email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com");
                            bValid = bValid && checkRegexp(phone, /^([0-9]|\d|[-])+$/, "Phone number can only be in the form 2242918 or 224-2918 ");
                            if (bValid) {
                                $("form#EditPatronForm").submit();
                                $(this).dialog("close");
                            }
                        },
                        Cancel: function() {
                            $(this).dialog("close");
                        }
                    },
                    close: function() {
                        allFields.val("").removeClass("ui-state-error");
                    }
                });

                $("#edit")
                        .button()
                        .click(function() {
                            $("#dialogEdit").dialog("open");
                        });
            });

            $(function() {
                $("#radio").buttonset();
            });


        </script>
    </head>
    <body>
        <?php
        include './Headers/dbConnect.php';
        include './Headers/checkAuth.php';

        if (isset($_COOKIE["patronAccount"]))
            $pId = $_COOKIE["patronAccount"];
        else
            header("Location: App_Index.php");
        ?>
        <div>
            <a href="App_Index.php"><button>Go Back</button></a>
        </div>

        <!Edit patron Information dialog format>  
    <div id="dialogEdit" title="Edit Contact Information">
        <p class="validateTips">All form fields are required.</p>
        <form id="EditPatronForm" action="Processing/Patron/updatePatron.php" method="post">
            <fieldset>
                <?php
                $existingDate = mysql_query("select * From Patron Where pAccount='$pId'");

                while ($row = mysql_fetch_assoc($existingDate)) {
                    $name = $row['name'];
                    $addr = $row['address'];
                    $mail = $row['email'];
                    $pNo = $row['phone'];
                }
                ?>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $name ?>" class="text ui-widget-content ui-corner-all">
                <label for="addr">Address</label>
                <input type="text" name="addr" id="addr" value="<?php echo $addr ?>"  class="text ui-widget-content ui-corner-all">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $mail ?>" class="text ui-widget-content ui-corner-all">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone" id="phone" value="<?php echo $pNo ?>" class="text ui-widget-content ui-corner-all">
                <input type="hidden" name="id" id="id" value="<?php echo $pId ?>" class="text ui-widget-content ui-corner-all">
            </fieldset>
        </form>
    </div> 

    <!Dialog box for renewing an item>   
    <div id="dialog-form1" title="Renew Item">
        <fieldset>
            <form id="RenewItemForm" action="Processing/Patron/renewItem.php" method="post">

                <?php $query2 = mysql_query("Select * From Loan Inner Join Item On Loan.libraryCode=Item.libraryCode Where pAccount='$pId'"); ?>
                <table id="Fines" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Item</th>
                            <th>Date due</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query3 = mysql_query("Select * From Loan Inner Join Item On Loan.libraryCode=Item.libraryCode Where pAccount='$pId' and returned Is NULL");
                        error_log(print_r($_REQUEST, true));

                        if ($query3) {
                            echo "Success";
                        } else {
                            echo "Error in sending your user";
                            echo "could not insert into Item table <br />";
                            trigger_error(mysql_error(), E_USER_ERROR);
                        }
                        while ($row = mysql_fetch_assoc($query3)) {
                            echo'<tr>';
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['dateDue'] . "</td>";
                            echo "<td><input type='checkbox' value=" . $row['loanNum'] . " name='check[]'/></td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <div id='radio'>
                    <?php
                    $oneweek = date("y-m-d", strtotime("+1 week"));
                    $twoweeks = date("y-m-d", strtotime("+2 week"));
                    $threeweeks = date("y-m-d", strtotime("+3 week"));
                    ?>
                    <input type="radio" id="radio1" name="radio" value=<?php echo $oneweek ?>><label for="radio1">One Week</label>
                    <input type="radio" id="radio2" name="radio" checked="checked" value=<?php echo $twoweeks ?>><label for="radio2">Two weeks</label>
                    <input type="radio" id="radio3" name="radio" value=<?php echo $threeweeks ?>><label for="radio3">Three weeks</label>
                </div>
            </form>
        </fieldset>
    </div>    

    <!Dialog box for removing a hold>   
    <div id="RemoveHold" title="Cancel Hold">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you want to cancel the Hold</p>
    </div>


    <div id="dialog-formPay" title="Pay/Waive Fines">

        <form id="FineConfirm" action='Processing/Patron/PWFines.php' method="post">
            <fieldset>
                <table id="Fines" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Item</th>
                            <th>Fine</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query3 = mysql_query("Select * From Fine Inner Join Item On Fine.libraryCode=Item.libraryCode Where pAccount='$pId' and Not balance='0'");
                        while ($row = mysql_fetch_assoc($query3)) {
                            echo'<tr>';
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['balance'] . "</td>";
                            echo "<td><input type='checkbox' value=" . $row['fineNo'] . " name='check[]'/></td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <p class="validateTips">All form fields are required.</p>
                <label for="waive">Waive $</label>
                <input type="number" name="waive" id="waive" value="" class="text ui-widget-content ui-corner-all">
                <label for="payment">Pay $</label>
                <input type="number" name="payment" id="payment" value="" class="text ui-widget-content ui-corner-all">
                <label for="Handled">Handled By</label>
                <input type="text" name="Handled" id="Handled" value="" class="text ui-widget-content ui-corner-all">
                <?php
                $date = date('Y-m-d');
                ?>
                <label>Payed on:<label type="date" value=""><?php echo $date ?></label></label>
            </fieldset>
        </form>
    </div>

    <div id="dialog-formConfirm" title="Pay/Wavier Fines">
        <form>
            <fieldset>
                <label id="waiveC">Waive $</label>
                <label id="payC">Pay $</label>
                <label id="patronC">Patron: </label>
                <label id="HandledByC">Handled By</label>
                <label>Payed on: <?php echo $date ?></label>
            </fieldset>
        </form>
    </div>

    <div id="accordion">
        <h3>Contact Information</h3>
        <div>    
            <h1>Information:</h1>
            <div id="Info_table">
                <table id="pInformation" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <?php $query = mysql_query("Select * From Patron Where pAccount='$pId'"); ?>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Member Since</th>
                            <th>Expires </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            while ($row = mysql_fetch_array($query)) {

                                echo '<tr>';
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['membershipStartDate'] . "</td>";
                                echo "<td>" . $row['membershipExpiryDate'] . "</td>";
                                echo '</tr>';
                            }
                            ?>

                        </tr>
                    </tbody>
                </table>
            </div>

            <button id="edit">Edit</button>
        </div>

        <h3>Loans</h3>
        <div>
            <h1>Loans:</h1>
            <div id="Info_table">
                <?php $query2 = mysql_query("Select * From Loan Inner Join Item On Loan.libraryCode=Item.libraryCode Where pAccount='$pId' and returned is NULL"); ?>
                <table id="loans" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Title</th>
                            <th>Stock Number</th>
                            <th>Date Loaned</th>
                            <th>Due Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rows = mysql_fetch_assoc($query2)) {
                            echo '<tr>';
                            echo "<td>" . $rows['title'] . "</td>";
                            echo "<td>" . $rows['stocknum'] . "</td>";
                            echo "<td>" . $rows['dateLoaned'] . "</td>";
                            echo "<td>" . $rows['dateDue'] . "</td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button id="renew">Renew</button>
        </div>

        <h3>Holds</h3>
        <div>
            <div>
                <h1>Holds:</h1>
                <div id="Info_table">
                    <form id="cancelHoldForm" action="Processing/Holds/cancelHold.php" method="post">
                        <?php $query = mysql_query("Select * From Hold natural join Item Where pAccount='$pId' and pickupDate is NULL"); ?>
                        <table id="Holds" class="ui-widget ui-widget-content">
                            <thead>
                                <tr class="ui-widget-header ">
                                    <th>Title</th>
                                    <th>Stock #</th>
                                    <th>Held On</th>
                                    <th>Date Available</th>
                                    <th>Expiry Date</th>
                                    <th>Selected</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysql_fetch_assoc($query)) {
                                    echo'<tr>';
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['stocknum'] . "</td>";
                                    echo "<td>" . $row['dateHeld'] . "</td>";
                                    echo "<td>" . $row['availDate'] . "</td>";
                                    echo "<td>" . $row['expiryDate'] . "</td>";
                                    $checkboxId = 'checkbox-'.$row['pAccount'].'-'.$row['libraryCode'].'-'.$row['stocknum'];
                                    echo "<td><input type='checkbox' class='chckbtl' name='$checkboxId' /></td>";
                                    echo '</tr>';
                                }
                                ?>     
                            </tbody>
                        </table>
                    </form>
                </div>
                <button id="Cancel">Cancel</button>
            </div>
        </div>   

        <h3>Fines</h3>
        <div>
            <h1>Fines:</h1>
            <div id="Info_table">
                <?php $query3 = mysql_query("Select * From Fine Inner Join Item On Fine.libraryCode=Item.libraryCode Where pAccount='$pId' and NOT balance='0'"); ?>
                <table id="Fines" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Item</th>
                            <th>Reason</th>
                            <th>Fine</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysql_fetch_assoc($query3)) {
                            echo'<tr>';
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['reason'] . "</td>";
                            echo "<td>" . $row['balance'] . "</td>";
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <button id="payWaiverFines">Pay/Waiver</button>
        </div>
    </body>
</html>
