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
    $("form#EditPatronForm").submit();
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

<body>
    <?php
     $server = mysql_connect("localhost","root", "root");
            $db =mysql_select_db("library", $server);

            $pId=$_COOKIE['pID'];
        //$pId=1234567890;
    ?>
<div>
<a href="PatronTab.php"><button>Go Back</button></a>
</div>
<!Edit patron Information dialog format>  
<div id="dialogEdit" title="Edit Contact Information">
<p class="validateTips">All form fields are required.</p>
<form id="EditPatronForm" action="updatePatron.php" method="post">
<fieldset>
<?php
    $existingDate=mysql_query("select * From Patron Where pAccount='$pId'");
    
    while($row=mysql_fetch_assoc($existingDate)){
        $name=$row['name'];
        $addr=$row['address'];
        $mail=$row['email'];
        $pNo=$row['phone'];
     }?>
       <label for="name">Name</label>
       <input type="text" name="name" id="name" value="<? echo $name?>" class="text ui-widget-content ui-corner-all">
       <label for="addr">Address</label>
       <input type="text" name="addr" id="addr" value="<?php echo $addr?>"  class="text ui-widget-content ui-corner-all">
       <label for="email">Email</label>
       <input type="text" name="email" id="email" value="<?php echo $mail?>" class="text ui-widget-content ui-corner-all">
       <label for="phone">Phone Number</label>
       <input type="phone" name="phone" id="phone" value="<?php echo $pNo?>" class="text ui-widget-content ui-corner-all">
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
<label for="pay">Pay $<label id="pay"> $</label></label>
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
<?php $query=mysql_query("Select name, address, email, phone From Patron Where pAccount='$pId'");?>
<th>Name</th>
<th>Address</th>
<th>Email</th>
<th>Phone</th>
</tr>
</thead>
<tbody>
<tr>
<?php
while ($row=mysql_fetch_array($query)){
    
echo '<tr>';
echo "<td>".$row['name']."</td>";
echo "<td>".$row['address']."</td>";
echo "<td>".$row['email']."</td>";
echo "<td>".$row['phone']."</td>";
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
<?php $query2=mysql_query("Select title, dateLoaned, dateDue From Loan inner join Item on Loan.libraryCode=Item.libaryCode Where pAccount='$pId'");?>
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
  <?php
while($rows=mysql_fetch_assoc($query2)){
echo '<tr>';
echo "<td>".$row['title']."</td>";
echo "<td>".$row['dateLoaned']."</td>";
echo "<td>".$row['dateDue']."</td>";
echo '</tr>';
}?>
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
<?php $query=mysql_query("Select title, dateHeld, availDate From Hold INNER JOIN Item ON Hold.libraryCode=Item.libaryCode Where pAccount='$pId'");?>
<table id="Holds" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th>Title</th>
<th>Held At</th>
<th>Pickup Date</th>
</tr>
</thead>
<tbody>
    <?php
 while($row=  mysql_fetch_array($query)){
echo'<tr>';
echo "<td>".$row['title']."</td>";
echo "<td>".$row['dateHeld']."</td>";
echo "<td>".$row['availDate']."</td>";
echo '</tr>';}
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
<?php $query=mysql_query("Select title, reason, amountCharged From Fines INNER JOIN Item ON Fines.libraryCode=Item.libaryCode Where pAccount='$pId'");?>
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
 while($row=mysql_fetch_array($query)){
echo'<tr>';
echo "<td>".$row['title']."</td>";
echo "<td>".$row['reason']."</td>";
echo "<td>".$row['amountCharged']."</td>";
echo '</tr>';}
?>
</tbody>
</table>
</div>
<button id="payWaiverFines">Pay/Waiver</button>
</div>
</body>
