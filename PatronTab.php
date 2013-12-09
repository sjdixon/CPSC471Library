<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Dialog - Modal form</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
body { font-size: 62.5%; }
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
<script type="text/javascript"> 
$(function(){
   //$function 
});
//add  new patron           
$(function() {
var id=$("#pid"), 
name = $( "#name" ),
email = $( "#email" ),
address = $( "#address"),
phone=$("#phone");
 allFields = $( [] ).add( name ).add( email ).add( address ) .add(phone) .add(id),
tips = $( ".validateTips" );
function updateTips( t ) {
tips
.text( t )
.addClass( "ui-state-highlight" );
setTimeout(function() {
tips.removeClass( "ui-state-highlight", 1500 );
}, 500 );
}
function checkLength( o, n, min, max ) {
if ( o.val().length > max || o.val().length < min ) {
o.addClass( "ui-state-error" );
updateTips( "Length of " + n + " must be between " +
min + " and " + max + "." );
return false;
} else {
return true;
}
}
function checkRegexp( o, regexp, n ) {
if ( !( regexp.test( o.val() ) ) ) {
o.addClass( "ui-state-error" );
updateTips( n );
return false;
} else {
return true;
}
}
$( "#dialog-form" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Create an account": function() {
  
   var bValid = true;
allFields.removeClass( "ui-state-error" );
bValid = bValid && checkLength( name, "name", 1, 50 );
bValid = bValid && checkLength( email, "email", 1, 50 );
bValid = bValid && checkLength( address, "address", 1, 45 );
bValid = bValid && checkLength( phone, "phone", 10, 11 );
bValid = bValid && checkLength( id, "id", 10, 10 );

bValid = bValid && checkRegexp( name, /^([a-zA-Z])+$/i, "Name may consist of a-z, begin with a letter." );
bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
bValid = bValid && checkRegexp( address, /^([0-9a-zA-Z])+$/, "Address field only allow : a-z 0-9" );
bValid = bValid && checkRegexp( id, /^([0-9])+$/, "Id field only allow :0-9" );
bValid = bValid && checkRegexp( phone, /^([0-9])+$/, "Phone field only allow :0-9" );
    if(bValid){
               $("form#nPatron").submit();         
               $( this ).dialog( "close" );
              }
},
Cancel: function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#add" )
.button()
.click(function() {
$( "#dialog-form" ).dialog( "open" );
});
});
//selector
$(function() {
$( "#selected" ).buttonset();
});
//remove
 $(function() {
$( "#dialog-confirm" ).dialog({
autoOpen: false,
height: 100,
width: 300,
modal: true,
buttons: {
"Delete Patron(s)": function(){
      var searchIDs = $("#users input:checkbox:checked").map(function(){
      return $(this).val();
    }).get();
      alert(searchIDs[0]);
    $.ajax({
        url : 'removePatron.php',
        method: 'post',
        data : { pIds : searchIDs }
    });

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
$( "#remove" )
.button()
.click(function() {
$( "#dialog-confirm" ).dialog( "open" );
});
});
//search
function Search() {
    }
function setCookie(){
    
      function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
         }
         
        $('button[name=button]').click(function(){
        var id= $(this).attr("id");
        createCookie("id", id,1);
   }); }

</script>
</head>
<body>   
<div id="dialog-confirm" title="Delete Patrons">
<form id='rPatron' action='removePatron.php' method='post'>
<p>These Patrons will be permanently deleted. Are you sure?</p>
</div>

<div id="dialog-form" title="Add a New Patron">
<form id="nPatron" action="NewPatron.php" method="post">
<p class="validateTips">All form fields are required.</p>    
<fieldset>
<label for=pid">Account Number</label>
<input type="number" name="pid" id="pid" class="text ui-widget-content ui-corner-all">
<label for="name">Name</label>
<input type="text" name="name" id="name"  class="text ui-widget-content ui-corner-all">
<label for="email">Email</label>
<input type="text" name="email" id="email"  class="text ui-widget-content ui-corner-all">
<label for="address">Address</label>
<input type="text" name="address" id="address" class="text ui-widget-content ui-corner-all">
<label for="phone">Phone</label>
<input type="text" name="phone" id="phone" class="text ui-widget-content ui-corner-all">
</fieldset>
</form>
</div>

<div>
    
    
    <input type="text" name="nameSearch" id="nameSearch" value="Search Name" class="text ui-widget-content ui-corner-all">
    <input type="number" name="idSearch" id="idSearch" value="Search Id" class="text ui-widget-content ui-corner-all">
    <input type="submit" value="Search">

    <button id="add">Add new Patron</button>
    <button id="remove">Remove</button>
</div>
<div id="users-contain" class="ui-widget">
<!This is the table that stores the values provided by the php above>
<h1></h1>
<?php
            $server = mysql_connect("localhost","root", "root");
            $db =mysql_select_db("library", $server);
                $t=time();
                $date=date_create(date("y-m-d", $t));
                $holdDate=  mysql_query("Select expiryDate, pAccount, libraryCode FROM Hold");
            
                while($row= mysql_fetch_assoc($holdDate)){
                 $date2=new DateTime($row['expiryDate']);
                $diff=date_diff($date,$date2);
                $timeDiff=$diff->format(a);
                if($timeDiff>0){
                    $maxFineNum=mysql_query("SELECT MAX(fineNo) FROM Fine");
                    $maxFineNum++;
                    $accountNo=$row['pAccount'];
                    $itemCode=$row['libraryCode'];
                    mysql_query("INSERT INFO Fines (fineNo, pAccount, libraryCode, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','Hold','$date')");
                }}
                //checks for overdue loans
                $loanDates=mysql_query("Select dateLoaned, pAccount, libraryCode, stockNum FROM Loan");
                while($row=mysql_fetch_array($loanDates)){
                $date2=new DateTime($row['dateLoaned']);
                $diff=date_diff($date, date2);
                $timeDiff=$diff->format(a);
                if($timeDiff>0){
                    $maxFineNum=mysql_query("SELECT MAX(fineNo) FROM Fine");
                    $maxFineNum++;
                    $accountNo=$row['pAccount'];
                    $itemCode=$row['libraryCode'];
                    $instance=$row['stockNum'];
                    mysql_query("INSERT INFO Fines (fineNo, pAccount, libraryCode, stockNum, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','$instance','Loan','$date')");
                }
                }
                //Checks for expired Cards
                $false=FALSE;
                $true=TRUE;
                $expiredCards=mysql_query("SELECT membershipExpiryDate, pAccount FROM Patron WHERE membershipExpired='$false'");
                while($row=mysql_fetch_array($expiredCards)){
                    $date2=new DateTime($row['membershipExpiryDate']);
                    $diff=date_diff($date,$date2);
                    $timeDiff=$diff->format('%a');    
                    if($timeDiff>0){
                         $accountNo=$row['pAccount'];
                         mysql_query("UPDATE Patron SET membershipExpired=$true WHERE pAccount='$accountNo'");
                    }
                }
            $query1 = mysql_query("select * from Patron");
            
            ?>
            <table id="users" class="ui-widget ui-widget-content">
                <thead>
                    <tr id="row" class="ui-widget-header ">
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Membership_Expired</th>
                        <th>User_Profile</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    while ($row=mysql_fetch_array($query1)){
                        $expireValue="";
                        if($row['membershipExpired']==1)
                        { $expireValue="No"; }
                        else{ $expireValue="Yes"; }
                   
                    echo "<tr>";
                    echo "<td><input type='checkbox' value=".$row['pAccount']." name='check[]'/></td>";  
                    echo "<td name='id'>".$row['pAccount']."</td>";
                    echo "<td name='name'>".$row['name']."</td>";
                    echo "<td>".$expireValue."</td>";
                    echo "<td><a href='PatronInformation.php'><button id=".$row['pAccount']." onclick='setCookie()'>View</button></a></td>";
                    echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
</div>
</body>
</html>