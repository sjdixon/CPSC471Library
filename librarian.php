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
                var name = $("#name"),
                        username = $("#username"),
                        allFields = $([]).add(name).add(username),
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


                            if (bValid) {
                                $("form#addLibrarianForm").submit();
                                $("#users tbody").append("<tr>" +
                                        "<td>" + name.val() + "</td>" +
                                        "<td>" + $.datepicker.formatDate('yy-mm-dd', new Date())
                                        + "</td>" +
                                        "<td></td>" +
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
                $("#remove-user-form").dialog({
                    autoOpen: false,
                    height: 300,
                    width: 350,
                    modal: true,
                    buttons: {
                        close: function() {
                            $(this).dialog("close");
                        }
                    }
                });
                $("#remove-user").button().click(function() {
                    $("#remove-user-form").dialog("open");
                });
            });
        </script>
    </head>

    <body>
        <div id="dialog-form" title="Create new user">
            <p class="validateTips">All form fields are required.</p>
            <form id="addLibrarianForm" action="addLibrarian.php" method="post">
                <fieldset>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="text ui-widget-content ui-corner-all">
                </fieldset>
            </form>
        </div>
        <div id="remove-user-form" title="Remove User">
                <p> Got something</p>
            <form id="removeLibrarianForm" action="removeLibrarian.php" method="post">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
            </form>
        </div>

        <div id="users-contain" class="ui-widget">
            <h1>Existing Users:</h1>

            <?php
            $server = mysql_connect("localhost", "ubuntu", "stephen123");
            $db = mysql_select_db("library", $server);
            $query = mysql_query("select * from Librarian where endDate is NULL");
            ?>


            <table id="users" class="ui-widget ui-widget-content">
                <thead>
                    <tr class="ui-widget-header ">
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysql_fetch_array($query)) {
                        echo "<tr>";
                        echo "<td>" . $row[name] . "</td>";
                        echo "<td>" . $row[startDate] . "</td>";
                        echo "<td>" . $row[username] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <button  id="create-user">Create new user</button>
        <button id="remove-user">Delete User </button>
    </body>
</html>
