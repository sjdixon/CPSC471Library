<script type="text/javascript"> 

//add new patron           
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
//This function checks the length of the string
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
bValid = bValid && checkLength( phone, "phone", 7, 11 );
bValid = bValid && checkLength( id, "id", 1, 10 );

bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
bValid = bValid && checkRegexp( id, /^([0-9])+$/, "Id field only allow :0-9" );

    if(bValid){
              document.getElementById('nPatron').submit();
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
$( "#addPatron" )
.button()
.click(function() {
$( "#dialog-form" ).dialog( "open" );
});
});
//remove
 $(function() {
$( "#dialog-confirm" ).dialog({
autoOpen: false,
height: 150,
width: 300,
modal: true,
buttons: {
"Delete Patron(s)": function(){
    //This gets the values from each checkbox that is checked
      var searchIDs = $("#users input:checkbox:checked").map(function(){
      return $(this).val();
    }).get();
    //Using Ajax function to jump to the remove Patron file, all checked Patrons are removed
    $.ajax({
        url : 'removePatron.php',
        method: 'post',
        data : { pIds : searchIDs }
    });
//Since the page is not refreshed after using Ajax, this deletes checked rows from the html table  
patronTable = document.getElementById('users');
selected = document.getElementsByName('check[]');
for (i=selected.length-1; i>=0; i--)
{if (selected[i].checked === true){patronTable.deleteRow(i+1)}}
 
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

$( "#removePatron" )
.button()
.click(function() {
$( "#dialog-confirm" ).dialog( "open" );
});
});

//Filters the table when a value is typed in.
$(document).ready(function() {
  var $rows=$("#users tbody>tr"), $cells=$rows.children();
  $("#textSearch").keyup(function() {
       var term = $(this).val()
       //If the something has been entered into the text box, It will first hide all the rows
       //Then if the value inside of a cell in one of the rows matches the entered term then those rows are displayed
       //If nothing has been entered all of the rows in the table are appear
       if(term != "") {
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

<body>   
<div id="dialog-confirm" title="Delete Patrons">
<form id='rPatron' action='removePatron.php' method='post'>
<p>These Patrons will be permanently deleted</p>
</form>
</div>

<div id="dialog-form" title="Add a New Patron">
<p class="validateTips">All form fields are required.</p> 
<form id="nPatron" name='nPatron' action='NewPatron.php' method='post' >
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
    <label for="textSearch">Search Table</label>
    <input type="text" id="textSearch" class="text ui-widget-content ui-corner-all">
</div>
<div id="users-contain" class="ui-widget">
<!This is the table that stores the values provided by the php above>
<h1></h1>
<?php
            setcookie("patronAccount", "", time()-3600);

            $server = mysql_connect("localhost","root", "root");
            $db=mysql_select_db("library", $server);
                $t=time();
                $date=date('Y-m-d');
                $holdDate=mysql_query("Select expiryDate, pAccount, libraryCode FROM Hold");
               
                while($row= mysql_fetch_assoc($holdDate)){
                 $dateExpire=$row['expiryDate'];
                    
                    if(strtotime($date)>strtotime($dateExpire)){
                        $maxFineNum=mysql_query("SELECT MAX(fineNo) FROM Fine");
                        $maxFineNum++;
                        $accountNo=$row['pAccount'];
                        $itemCode=$row['libraryCode'];
                        $fineList=mysql_query("Select * From Fine Where pAccount='$accountNo' And libraryCode='$itemCode' And Not balance='0'");
             
                        if(!$row=mysql_fetch_assoc($fineList))
                        {mysql_query("INSERT INFO Fines (fineNo, pAccount, libraryCode, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','Hold','$date')");}
                        else
                        {
                         while($row=mysql_fetch_assoc($fineListt)){
                             $balance=$_POST['balance'];
                             $bal=$balance+0.20;
                             $fineNo=$_POST['fineNo'];
                             mysql_query("Update Fine Set balance='$bal', Where fineNo='$fineNo'");
                         }
                        }
                    }   
                 }
                //checks for overdue loans
                $loanDates=mysql_query("Select dateLoaned, pAccount, libraryCode, stockNum FROM Loan");
                while($row=mysql_fetch_array($loanDates)){
                 $dateExpire=$row['dateLoaned'];
       
                    if(strtotime($date)>strtotime($dateExpire)){
                        $maxFineNum=mysql_query("SELECT MAX(fineNo) FROM Fine");
                        $maxFineNum++;
                        $accountNo=$row['pAccount'];
                        $itemCode=$row['libraryCode'];
                        $instance=$row['stockNum'];
                         $fineList=mysql_query("Select * From Fine Where pAccount='$accountNo' And libraryCode='$itemCode' And stocknum='$instance' And Not balance='0'");
             
                        if(!$row=mysql_fetch_assoc($fineList))
                        {
                            mysql_query("INSERT INFO Fines (fineNo, pAccount, libraryCode, stockNum, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','$instance','Loan','$date')");
                        }
                        else {
                            while($row=mysql_fetch_assoc($fineListt)){
                             $balance=$_POST['balance'];
                             $bal=$balance+0.20;
                             $fineNo=$_POST['fineNo'];
                             mysql_query("Update Fine Set balance='$bal', Where fineNo='$fineNo'");
                         }
                        }
                     }
                }
                //Checks for expired Cards
                $false=FALSE;
                $true=TRUE;
                $expiredCards=mysql_query("SELECT membershipExpiryDate, pAccount FROM Patron WHERE membershipExpired='$false'");
                while($row=mysql_fetch_array($expiredCards)){
                    $dateE=$row['membershipExpiryDate'];
                    $dateEx=strtotime($dateE);
                    $dateExpire=idate('s', $dateEx);
                    $date=mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));
                    $dateCurrent=idate('s',$date);
                        
                if($dateCurrent>$dateExpire){
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
                        if($row['membershipExpired']==0)
                        { $expireValue="No"; }
                        else{ $expireValue="Yes"; }
                       
                        echo "<tr>";
                        echo "<td><input type='checkbox' value=".$row['pAccount']." name='check[]'/></td>";  
                        echo "<td>".$row['pAccount']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$expireValue."</td>";
                        echo "<td><form id='storeId' action='cacheId.php' method='post'>
                            <input type='hidden' id='pAccount' name='pAccount' value=".$row['pAccount'].">
                            <button type='sumbit'>View</button>
                            </form></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button id="addPatron">Add new Patron</button>
            <button id="removePatron">Remove Patron</button>
</div>
</body>
