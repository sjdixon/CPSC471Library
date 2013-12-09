<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Book a Book - Patron</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

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
$( "#accordion" ).accordion({
collapsible: true
});
});

$(function() {
$( "#dialog-form1" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Renew Item": function() {
$( this ).dialog( "close" );
},
Cancel: function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#Renew" )
.button()
.click(function() {
$( "#dialog-form1" ).dialog( "open" );
});
});

 $(function() {
$( "#radio" ).buttonset();
});
//Date Picker
 $(function() {
$( "#datepicker" ).datepicker({
showOn: "button",
buttonImage: "images/calendar.gif",
buttonImageOnly: true


});
});
//Hold dialog Function
 $(function() {
$( "#RemoveHold" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Remove Hold": function() {
$( this ).dialog( "close" );
},
Cancel: function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#Cancel" )
.button()
.click(function() {
$( "#RemoveHold" ).dialog( "open" );
});
});
//Fines Pay page
 $(function() {
var Waiver = $( "#waiver" ),
Pay = $( "#pay" ),
Handled = $( "#Handled" ),
allFields = $( [] ).add( Waiver ).add( Pay ).add( Handled ),
tips = $( ".validateTips" );
function updateTips( t ) {
tips
.text( t )
.addClass( "ui-state-highlight" );
setTimeout(function() {
tips.removeClass( "ui-state-highlight", 1500 );
}, 500 );
}

$( "#dialog-formPay" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Pay/Waiver Fines": function() {
$( "#dialog-formConfirm" ).dialog( "open" );
$( this ).dialog( "close" );

},
Cancel: function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#payWaiverFines" )
.button()
.click(function() {
$( "#dialog-formPay" ).dialog( "open" );
});
});

 $(function() {
$( "#dialog-formConfirm" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Ok": function() {
$( this ).dialog( "close" );
},
"Go Back": function() {
$( "#dialog-formPay" ).dialog( "open" );
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#payWaiverFines" )
.button()
.click(function() {
$( "#dialog-formPay" ).dialog( "open" );
});
});

//Dialog box for Editing Patrons
$(function() {
var name= $( "#name" ),
addr = $( "#addr" ),
email = $( "#email" ),
phone = $("#phone"),
allFields = $( [] ).add( name ).add( addr ).add( email ) .add(phone),
tips = $( ".validateTips" );
function updateTips( t ) {
tips
.text( t )
.addClass( "ui-state-highlight" );
setTimeout(function() {
tips.removeClass( "ui-state-highlight", 1500 );
}, 500 );
}

$( "#dialogEdit" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Commit": function() {
$( this ).dialog( "close" );
},
Cancel: function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});

$( "#edit" )
.button()
.click(function() {
$("#dialogEdit").dialog( "open" );
});
});
</script>
</head>
<body>
    <?php
     $server = mysql_connect("localhost","root", "root");
            $db =mysql_select_db("library", $server);
      
    ?>
<div>
<a href="PatronTab.php"><button>Go Back</button></a>
</div>
<!Edit patron Information dialog format>  
<div id="dialogEdit" title="Edit Contact Information">
<p class="validateTips">All form fields are required.</p>
<form>
<fieldset>
<label for="name">Name</label>
<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
<label for="addr">Address</label>
<input type="text" name="addr" id="addr" class="text ui-widget-content ui-corner-all">
<label for="email">Email</label>
<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
<label for="phone">Phone Number</label>
<input type="phone" name="phone" id="phone" value="" class="text ui-widget-content ui-corner-all">
</fieldset>
</form>
</div> 
<!Dialog box for renewing an item>   
<div id="dialog-form1" title="Renew Item">
<form>
<fieldset>
<form action="process.php" method="post"> 
  <p>Date:</p><input type="text" id="datepicker" name="datepicker" value="Date"/>
</form>
</fieldset>
</form>
</div>    
<!Dialog box for removing a hold>   
<div id="RemoveHold" title="Cancel Hold">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you want to cancel the Hold</p>
</div>
   
<div id="dialog-formPay" title="Pay/Wavier Fines">
<p class="validateTips">All form fields are required.</p>
<p class="validateTips"> Amount Owed: $</p>
<form>
<fieldset>
<label for="waiver">Waiver $</label>
<input type="text" name="waiver" id="waiver" class="text ui-widget-content ui-corner-all">
<label for="pay">Pay $</label>
<input type="text" name="pay" id="pay" value="" class="text ui-widget-content ui-corner-all">
<label for="Handled">Handled By</label>
<input type="text" name="Handled" id="Handled" value="" class="text ui-widget-content ui-corner-all">
<label>Payed on:<label type="date" value=""></label></label>
</fieldset>
</form>
</div>

<div id="dialog-formConfirm" title="Pay/Wavier Fines">
<p class="validateTips"> Amount Owned</p>
<form>
<fieldset>
<label for="waiver">Waiver $<label id="waiver"></label></label>
<label for="pay">Pay $<label id="pay"></label></label>
<lebel for="Patron">Patron: </label>
<label for="Handled">Handled By<label id="HandledBy"></label></label>
<label>Payed on:</label>
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

<th>Name</th>
<th>Address</th>
<th>Email</th>
<th>Phone</th>
</tr>
</thead>
<tbody>
<tr>
<td>""</td>
<td>""</td>
<td>""</td>
<td>""</td>
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
<table id="loans" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th>Title</th>
<th>Date Loaned</th>
<th>Due Date</th>
<th>Select</th>
</tr>
</thead>
<tbody>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
</div>
<button id="Renew">Renew</button>
</div>
 
<h3>Holds</h3>
<div>
<div>
<h1>Holds:</h1>
<div id="Info_table">
<table id="Holds" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th>Title</th>
<th>Pickup Date</th>
</tr>
</thead>
<tbody>
<tr>
<td><ol id="selectable"><li>John Doe The Movie</li></ol></td>
<td></td>
</tr>
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
<table id="Fines" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th>Item</th>
<th>Reason</th>
<th>Fine</th>
</tr>
</thead>
<tbody>
<tr>
<td><ol id="selectable"><li>John Doe The Movie</li></ol></td>
<td></td>
</tr>
</tbody>
</table>
</div>
<button id="payWaiverFines">Pay/Waiver</button>
</div>
</body>
</html>