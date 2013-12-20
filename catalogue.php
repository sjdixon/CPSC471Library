

<script type="text/javascript">
    $(function() {
        var patronId = $("#patronId"),
                stock = $("#stock"),
                patronIdType = $("#patronIdType"),
                dueDate = $("#dueDate");
        allFields = $([]).add(stock).add(dueDate).add(patronId),
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

        $("#loanholdDialog").dialog({
            autoOpen: false,
            height: 450,
            width: 600,
            modal: true,
            buttons: {
                "Create loan/Hold": function() {

                    var bValid = true;
                    allFields.removeClass("ui-state-error");

                    if (patronIdType.val() == "pAccount")
                    {
                        bValid = bValid && checkLength(patronId, "Patron Id", 1, 10);
                        bValid = bValid && checkRegexp(patronId, /^([0-9])+$/, "The patron Identification field must be a number");
                    }
                    if (patronIdType.val() == "phone") {
                        bValid = bValid && checkLength(patronId, "Patron phone number", 7, 7);
                        bValid = bValid && checkRegexp(patronId, /^([0-9])+$/, "The patron Identification field must be a number");
                    }
                    if (patronIdType.val() == "name") {
                        bValid = bValid && checkLength(patronId, "Patron's name", 1, 45);
                    }
                    if (patronIdType.val() == "email") {
                        bValid = bValid && checkLength(patronId, "Patron's email", 1, 45);
                        bValid = bValid && checkRegexp(patronId, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@gmail.com");
                    }
                    if ($("input[name='radio']:checked").val() == 'loan') {

                        bValid = bValid && checkLength(stock, "Stock", 1, 4);
                        bValid = bValid && checkRegexp(stock, /^([0-9])+$/, "The stock field must be a number");
                        bValid = bValid && checkLength(dueDate, "Due Date", 10, 10);
                        bValid = bValid && checkRegexp(dueDate, /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/, "The date must be in the format yyyy-mm-dd");
                        //bValid = bValid && checkdate(dueDate, "Incorrect format/date");

                    }
                    if (bValid) {
                        $("form#operationForm").submit();
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

    });
    
    var code = "NOT SET";
    $('input:button').click(function() {
        var itemId = code;
        $("input[name='itemCode']").val(itemId);
        $('#codeLabel').html("Library Code: " + itemId);
        $("#loanholdDialog").dialog("open");
    });
    
    function populateValues(libraryCode){
        code = libraryCode;
    }



    $("#radio").buttonset();
    $("#dueDate").datepicker({minDate: 0, maxDate: "+3W", dateFormat: 'yy-mm-dd'});

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
    <div id="loanholdDialog" title="Add Loan/Hold">
        <p class="validateTips">All form fields are required.</p> 
        <form id="operationForm" method="post" action="Processing/Loans/process.php">

            <div id="radio" class="ui-widget">
                <input type="radio" id="loan" name="radio" checked="checked" class="radioSelect" value="loan"><label for="loan">Loan </label>
                <input type="radio" id="hold" name="radio" class="radioSelect" value="hold"><label for="hold">Hold</label>
            </div><br/>
            <div class="ui-widget">
                <select id="patronIdType" name="patronIdType">
                    <option value="pAccount">Library Account Number</option>
                    <option value="name">Patron Name</option>
                    <option value="phone">Phone Number</option>
                    <option value="email">Email</option>
                </select>
                <label for="patronId" > : </label>
                <input type="text" id="patronId" name="patronId">
            </div> <br/>
            <div class="ui-widget">
                <input hidden="true" name="itemCodeType" value="libraryCode" />
                <label for="itemCode">Library Code: </label>
                <input type='text' id="itemCode" name="itemCode" readonly> 
                <br>
                <label for="stock" class="loanOnly"> Stock# </label>
                <input id="stock" name="stock" class="loanOnly" type="text">
            </div> 

            <br>

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
                    <option value="3 day">Three Day</option>
                </select>
            </div>
        </form>
    </div>

    <div>   
        <a href="MainPage.php">Logout</a>
        <p>You can filter through our database by entering the title, genre, audience, year, or type of the item you wish to search for.</p>
        <p>All entered values must be must exactly match what you are looking for or it will not appear.</p>
        <input  type="text" id="searchString" name="searchString" size = "50"/>
        <?php
        include 'Headers/dbConnect.php';
        $itemList = mysql_query("Select * From Item");
        ?>
        <table id="ItemsTable" class="ui-widget ui-widget-content">
            <thead>
                <tr id="row" class="ui-widget-header ">
                    <th>Code</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Year</th>
                    <th>Shelf Location</th>
                    <th>Audience</th>
                    <th>Genre</th>
                    <th>Reference</th>
                    <th>Loan/Hold</th>
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
                    echo "<td>" . $row['libraryCode'] . "</td>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['itemType'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['shelfLoc'] . "</td>";
                    echo "<td>" . $row['audience'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $ref . "</td>";
                    $libraryCode = $row['libraryCode'];
                    echo "<td>
                         <input type='button' id='code' name='code' onclick=populateValues('$libraryCode') value='Loan/Hold'></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>

