<html>
    <body>
        <title>Item Returns</title>
        <script>
        $(function(){
                $("#dialog-return").dialog({
                    autoOpen: false,
                    height: 250,
                    width: 800,
                    modal: true,
                    buttons: {
                        "Return Item and Keep Window Open": function() {
                            $("form#returnForm").submit();
                        },
                        "Return Item and Close": function(){
                            $("form#returnForm").submit();
                            $(this).dialog("close");
                            
                        },
                        "Close Window": function() {
                            $(this).dialog("close");
                        }
                    }
                });
            $("#returnBtn").button().click(function(){
                $("#dialog-return").dialog("open");
            });
        });
        </script>
            
        <div id="dialog-return" title="Return Loaned Item" class="ui-widget">
            <form id="returnForm" method="post" action="Processing/Loans/returnItem.php">
                
                    <label for="returrnedLibraryCode"> Library Code: </label>
                    <input id="returnedLibraryCode" name="libraryCode"> <br/>
                    <label for="stock"> Stock# </label>
                    <input id="stocknum" name="stocknum" type="text"><br/>
                    
                    <label for="state">Action </label>
                    <select id="state" name="state">
                        <option value="OK"> Return Item</option>
                        <option value="Damaged"> Return & Mark as Damaged</option>
                        <option value="Discard"> Return & Mark as Discard</option>
                    </select>
            </form>
        </div>
        <button id="returnBtn"> Return Item</button></body>
</html>