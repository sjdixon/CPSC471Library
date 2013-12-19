//<html>
//    <body>
//        <title>Item Returns</title>
//        <script>
//        $(function(){
//                $("#return").dialog({
//                    autoOpen: false,
//                    height: 250,
//                    width: 800,
//                    modal: true,
//                    buttons: {
//                        "Return Item and Keep Window Open": function() {
//                            $("form#returnForm").submit();
//                        },
//                        "Return Item and Close": function(){
//                            $("form#returnForm").submit();
//                            $(this).dialog("close");
//                            
//                        },
//                        "Close Window": function() {
//                            $(this).dialog("close");
//                        }
//                    }
//                });
//            $("#returnBtn").button().click(function(){
//                $("#dialog-return").dialog("open");
//            });
//        });
//        </script>
//            
//                <button id="returnBtn"> Return Item</button></body>
//</html>