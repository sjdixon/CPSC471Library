<!-- Done by Rhianne -->
<!DOCTYPE html>
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
                            var renewDate = "";
                            var selected = $("#radio input[type='radio']:checked");
                            if (selected.length > 0) {
                                renewDate = selected.val();
                            }
                            var info = $("#Holds input:checkbox:checked").map(function() {
                                return $(this).val();
                            }).get();
                            $.ajax({
                                url: 'remewItem.php',
                                method: 'post',
                                data: {info: info,
                                    rDate: renewDate
                                }
                            });
                            window.location.href = "PatronInformation.php";
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
                            var holdID = $("#Holds input:checkbox:checked").map(function() {
                                return $(this).val();
                            }).get();

                            $.ajax({
                                url: 'CancelHold.php',
                                method: 'post',
                                data: {lCode: holdID}
                            });
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
                var Waiver = $("#waiver"),
                        Pay = $("#pay"),
                        Handled = $("#Handled"),
                        allFields = $([]).add(Waiver).add(Pay).add(Handled),
                        tips = $(".validateTips");
                function updateTips(t) {
                    tips
                            .text(t)
                            .addClass("ui-state-highlight");
                    setTimeout(function() {
                        tips.removeClass("ui-state-highlight", 1500);
                    }, 500);
                }

                $("#dialog-formPay").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Pay/Waiver Fines": function() {


                            var waive = $("#waive").val();
                            var waiveString = String(waive);
                            waiveString = "Waive: $".concat(waiveString.toString());
                            var payString = String($("#payment").val());
                            payString = "Pay: $".concat(payString.toString());
                            var handleString = String($("#Handled").val());
                            handleString = "Handled By: ".concat(handleString.toString());
                            document.getElementById('waiveC').innerHTML = waiveString;
                            document.getElementById('payC').innerHTML = payString;
                            document.getElementById('HandledByC').innerHTML = handleString;
                            document.getElementById('patronC').innerHTML = "Patron: " +<?php echo $_COOKIE["patronAccount"] ?>;

                            $("#dialog-formConfirm").dialog("open");
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
                $("#payWaiverFines")
                        .button()
                        .click(function() {
                            $("#dialog-formPay").dialog("open");
                        });
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

        //Dialog box for Editing Patrons
            $(function() {
                var name = $("#name"),
                        addr = $("#addr"),
                        email = $("#email"),
                        phone = $("#phone"),
                        allFields = $([]).add(name).add(addr).add(email).add(phone),
                        tips = $(".validateTips");
                function updateTips(t) {
                    tips
                            .text(t)
                            .addClass("ui-state-highlight");
                    setTimeout(function() {
                        tips.removeClass("ui-state-highlight", 1500);
                    }, 500);
                }

                $("#dialogEdit").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Commit": function() {
                            $("form#EditPatronForm").submit();
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
        $server = mysql_connect("localhost", "ubuntu", "stephen123");
        $db = mysql_select_db("library", $server);

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
        <form id="EditPatronForm" action="updatePatron.php" method="post">
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
            <form>
                <div id="radio">
                    <?php
                    $oneWeek = date("y-m-d", strtotime("+7 days"));
                    $twoWeeks = date("y-m-d", strtotime("+14 days"));
                    $threeWeeks = date("y-m-d", strtotime("+21 days"));
                    ?>
                    <input type="radio" id="renewOneWeek" name="radio" value=<?php echo $oneWeek ?> ><label for="renewOneWeek">One Week</label>
                    <input type="radio" id="renewTwoWeeks" name="radio" value=<?php echo $twoWeeks ?> ><label for="renewTwoWeeks">Two Weeks</label>
                    <input type="radio" id="renewThreeWeeks" name="radio" value=<?php echo $threeWeeks ?>><label for="renewThreeWeeks">Three Weeks</label>
                </div>
            </form>
        </fieldset>
    </div>    

    <!Dialog box for removing a hold>   
    <div id="RemoveHold" title="Cancel Hold">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you want to cancel the Hold</p>
    </div>


    <div id="dialog-formPay" title="Pay/Wavie Fines">
        <p class="validateTips">All form fields are required.</p>
        <form id="FineConfirm" action='PWFines.php' method="post">
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
                        $query3 = mysql_query("Select * From Fine Inner Join Item On Fine.libraryCode=Item.libraryCode Where pAccount='$pId'");
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

                <label for="waive">Waive $</label>
                <input type="number" name="waive" id="waive" class="text ui-widget-content ui-corner-all">
                <label for="payment">Pay $</label>
                <input type="number" name="payment" id="payment" value="" class="text ui-widget-content ui-corner-all">
                <label for="Handled">Handled By</label>
                <input type="number" name="Handled" id="Handled" value="" class="text ui-widget-content ui-corner-all">
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
<?php $query = mysql_query("Select name, address, email, phone From Patron Where pAccount='$pId'"); ?>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
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
<?php $query2 = mysql_query("Select * From Loan Inner Join Item On Loan.libraryCode=Item.libraryCode Where pAccount='$pId'"); ?>
                <table id="loans" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Title</th>
                            <th>Stock Number</th>
                            <th>Date Loaned</th>
                            <th>Due Date</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($rows = mysql_fetch_assoc($query2)) {
                            $info = array();
                            $info[] = $rows['libraryCode'];
                            $info[] = $rows['stocknum'];
                            $info[] = $rows['dateLoaned'];
                            $infoStr = implode(",", $info);
                            echo '<tr>';
                            echo "<td>" . $rows['title'] . "</td>";
                            echo "<td>" . $rows['stocknum'] . "</td>";
                            echo "<td>" . $rows['dateLoaned'] . "</td>";
                            echo "<td>" . $rows['dateDue'] . "</td>";
                            echo "<td><input type='checkbox' value=$infoStr name='check[]'/></td>";
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
<?php $query = mysql_query("Select * From Hold Inner Join Item On Hold.libraryCode=Item.libraryCode Where pAccount='$pId'"); ?>
                    <table id="Holds" class="ui-widget ui-widget-content">
                        <thead>
                            <tr class="ui-widget-header ">
                                <th>Title</th>
                                <th>Held At</th>
                                <th>Pickup Date</th>
                                <th>Selected</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysql_fetch_assoc($query)) {
                                echo'<tr>';
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>" . $row['dateHeld'] . "</td>";
                                echo "<td>" . $row['availDate'] . "</td>";
                                echo "<td><input type='checkbox' value=" . $row['libraryCode'] . " name='check[]'/></td>";
                                echo '</tr>';
                            }
                            ?>     
                        </tbody>
                    </table>
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
