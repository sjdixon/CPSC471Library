<?php
/**
 * Created by Stephen Dixon
 */
include './Headers/checkAuth.php';
include './Headers/dbConnect.php';
?>

<html>

    <script>
        $(function() {
            $("#shelveBtn").button().click(function() {
                $("form#holdsToShelveForm").submit();
            });
            $("#unshelveBtn").button().click(function() {
                $("form#holdsToUnshelveForm").submit();
            });
        });

    </script>
    <body>
        <div id="holdsToShelve" class="ui-widget">
            <form id="holdsToShelveForm" action="Processing/Holds/shelve.php" method="post">
                <h1>New Holds</h1>
                <table id="newHoldsTable" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Patron Name</th>
                            <th>Item Title</th> 
                            <th>Code</th>
                            <th>Stock #</th>
                            <th>Avail Date</th>
                            <th>Expiry Date</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $newHoldsQuery = "select p.pAccount as id, p.name as name, i.title as title, h.libraryCode as libraryCode, h.availDate as availDate, h.expiryDate as expiryDate, h.stocknum as stock" .
                                " from Hold as h, Patron as p, Item as i" .
                                " where h.availDate is not null and h.expiryDate >= curdate() and h.shelfDate is null and h.pAccount=p.pAccount and h.libraryCode=i.libraryCode";
                        $newHolds = mysql_query($newHoldsQuery);
                        while ($row = mysql_fetch_array($newHolds)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['libraryCode'] . "</td>";
                            echo "<td>" . $row['stock'] . "</td>";
                            echo "<td>" . $row['availDate'] . "</td>";
                            echo "<td>" . $row['expiryDate'] . "</td>";
                            $checkboxId = "checkbox-" . $row['id'] . "-" . $row['libraryCode'] . "-" . $row['stock'];
                            echo "<td><input type='checkbox' class='chcktbl' name='$checkboxId' /></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <button  id="shelveBtn">Mark Holds As Shelved</button>
        </div>


        <div id="currentHolds" class="ui-widget">
            <h1>Existing Holds</h1>
            <table id="currentHoldsTable" class="ui-widget ui-widget-content">
                <thead>
                    <tr class="ui-widget-header ">
                        <th>Patron Name</th>
                        <th>Item Title</th> 
                        <th>Code</th>
                        <th>Stock #</th>
                        <th>Shelf Held</th>
                        <th>Expiry Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentHoldsQuery = "select p.name as name, i.title as title, h.libraryCode as libraryCode, h.shelfDate as shelfDate, h.expiryDate as expiryDate, h.stocknum as stock" .
                            " from Hold as h, Patron as p, Item as i" .
                            " where h.availDate is not null and h.expiryDate >= curdate() and h.shelfDate is not null and h.pAccount=p.pAccount and h.libraryCode=i.libraryCode".
                            " and pickupDate is null";  // since we don't want anything there thats been picked up
                    $currentHoldsQuery = mysql_query($currentHoldsQuery);
                    while ($row = mysql_fetch_array($currentHoldsQuery)) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td>" . $row['libraryCode'] . "</td>";
                        echo "<td>" . $row['stock'] . "</td>";
                        echo "<td>" . $row['shelfDate'] . "</td>";
                        echo "<td>" . $row['expiryDate'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <div id="holdsToUnshelve" class="ui-widget">
            <h1>Holds To Remove From Shelf</h1>
            <form id="holdsToUnshelveForm" action="Processing/Holds/unshelve.php" method="post">

                <table id="expiredHoldsTable" class="ui-widget ui-widget-content">
                    <thead>
                        <tr class="ui-widget-header ">
                            <th>Patron Name</th>
                            <th>Item Title</th> 
                            <th>Code</th>
                            <th>Stock #</th>
                            <th>Expiry Date</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $expiredHoldsQuery = "select p.name as name, i.title as title, h.libraryCode as libraryCode, h.pAccount as id, h.expiryDate as expiryDate, h.stocknum as stock" .
                                " from Hold as h, Patron as p, Item as i" .
                                " where h.availDate is not null and h.expiryDate <= curdate() and removalDate is null and h.pAccount=p.pAccount and h.libraryCode=i.libraryCode".
                                " and pickupDate is null";
                        $expiredHolds = mysql_query($expiredHoldsQuery);
                        while ($row = mysql_fetch_array($expiredHolds)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['libraryCode'] . "</td>";
                            echo "<td>" . $row['stock'] . "</td>";
                            echo "<td>" . $row['expiryDate'] . "</td>";
                            $checkboxId = "checkbox-" . $row['id'] . "-" . $row['libraryCode'] . "-" . $row['stock'];
                            echo "<td><input type='checkbox' class='chcktbl' name='$checkboxId' /></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <button  id="unshelveBtn">Mark Holds As Removed</button>
        </div>
    </body>
</html>