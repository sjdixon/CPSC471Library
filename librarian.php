<!-- 
Librarian User Management Page
By: Stephen Dixon
-->

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Manage Librarians</title>
        <script>
            $(function() {
                var name = $("#name"),
                        username = $("#username"),
                        password =$("#password"),
                        secondPassword=$("#cPassword"),
                        allFields = $([]).add(name).add(username).add(password) .add(secondPassword),
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
                function samePassword(p1, p2, n)
                {
                    if(p1.val()==p2.val())
                        {
                           return true; 
                        }
                        p1.addClass("ui-state-error");
                        p2.addClass("ui-state-error");
                        updateTips(n);
                        return false;
                }
                $("#dialog-form").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        "Create an account": function() {
                            var bValid = true;
                            allFields.removeClass("ui-state-error");
                            bValid = bValid && checkLength(name, "name", 3, 20);
                            bValid = bValid && checkLength(username, "username", 3, 16);
                            bValid = bValid && checkRegexp(username, /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter.");
                            // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
                            bValid = bValid && samePassword(password, secondPassword, "The passwords are not the same");

                            if (bValid) {
                                $("form#addLibrarianForm").submit();

                                // This would be useful if page didn't redirect
                                $("#users tbody").append("<tr>" +
                                        "<td>" + name.val() + "</td>" +
                                        "<td>" + $.datepicker.formatDate('yy-mm-dd', new Date())
                                        + "</td>" +
                                        "<td>" + username.val() + "</td>" +
                                        "</tr>");
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
                $("#create-user")
                        .button()
                        .click(function() {
                            $("#dialog-form").dialog("open");
                        });
                $("#terminate-user-form").dialog({
                    autoOpen: false,
                    height: 600,
                    width: 630,
                    modal: true,
                    buttons: {
                        "Delete Permanently": function() {
                            $("form#termLibrarians").attr("action", "Processing/Librarian/removeLibrarian.php");
                            $("form#termLibrarians").submit();
                            $(this).dialog("close");
                        },
                        "Mark Employment as Terminated": function() {
                            $("form#termLibrarians").submit();
                            $(this).dialog("close");
                        },
                        Close: function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#terminate-user").button().click(function() {
                    $("#terminate-user-form").dialog("open");
                });
            });
        </script>
    </head>

    <body>

        <?php
        $server = mysql_connect("localhost", "ubuntu", "stephen123");
        $db = mysql_select_db("library", $server);
        ?>

        <div id="dialog-form" title="Create new user">
            <p class="validateTips">All form fields are required.</p>
            <form id="addLibrarianForm" action="Processing/Librarian/addLibrarian.php" method="post">
                <fieldset>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all">
                    <label for="password">Enter Password</label>
                    <input type="password" name="password" id="password" class="text ui-widget-content ui-corner-all"/>
                     <label for="cPassword">Confirm Password</label>
                    <input type="password" name="cPassword" id="cPassword" class="text ui-widget-content ui-corner-all"/>
                </fieldset>
            </form>
        </div>
        <div id="terminate-user-form" title="Remove User">
            <form id="termLibrarians" action="Processing/Librarian/terminateLibrarian.php" method="post">
                <table id="termCands" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header">
                            <th>id</th>
                            <th>Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Username</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysql_query("select * from Librarian");
                        while ($row = mysql_fetch_array($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['startDate'] . "</td>";
                            echo "<td>" . $row['endDate'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            $checkboxId = "checkbox" . $row[id];
                            echo "<td><input type='checkbox' class='chcktbl' name='$checkboxId' /></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>

        <div id="users-contain" class="ui-widget">
            <h1>Existing Users</h1>
            <table id="users" class="ui-widget ui-widget-content">
                <thead>
                    <tr class="ui-widget-header ">
                        <th>id</th>
                        <th>Name</th> 
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysql_query("select * from Librarian");
                    while ($row = mysql_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['startDate'] . "</td>";
                        echo "<td>" . $row['endDate'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button  id="create-user">Create</button>
        <button id="terminate-user">Remove</button>
    </body>
</html>
