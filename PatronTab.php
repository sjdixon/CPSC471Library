

<script type="text/javascript"> 

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
bValid = bValid && checkLength( phone, "phone", 7, 11 );
bValid = bValid && checkLength( id, "id", 1, 10 );

bValid = bValid && checkRegexp( name, /^([a-zA-Z])+$/i, "Name may consist of a-z, begin with a letter." );
bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. ui@jquery.com" );
bValid = bValid && checkRegexp( address, /^([0-9a-zA-Z])+$/, "Address field only allow : a-z 0-9" );
bValid = bValid && checkRegexp( id, /^([0-9])+$/, "Id field only allow :0-9" );
bValid = bValid && checkRegexp( phone, /^([0-9]+[/-/])+$/, "Phone field only allow :0-9" );
    if(bValid){
              $("#nPatron").submit();
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
      var searchText=document.getElementById('searchName').value();
      var pTable=document.getElementById('#users');
      var pTableColumnCount;
      for(var rowIndex=0; rowIndex<pTable.rows.length; rowIndex++)
      {
          var rowdata='';
          if(rowIndex==0){
              pTableColumnCount=pTable.rows.item(rowIndex).cells.length();
              continue;
          }
          for(var columnIndex=1; columnIndex<pTableColumnCount; columnIndex++)
          {
              rowData+=pTable.row.item(rowIndex).cells.item(columnIndex).textContent
          }
          if(rowData.indexOf(searchText)==-1)
              ('#users')
          else
              pTable.rows.item(rowIndex).style.display='table-row';
      }
}
function setCookie(){
   
        var id=$(this).attr("id");
        alert(id);
        $.cookie('pID', id, { expires: 1 });
    }

</script>

<body>   
<div id="dialog-confirm" title="Delete Patrons">
<form id='rPatron' action='removePatron.php' method='post'>
<p>These Patrons will be permanently deleted. Are you sure?</p>
</div>

<div id="dialog-form" title="Add a New Patron">
<p class="validateTips">All form fields are required.</p>  
<form id="nPatron" action="Processing/Patron/NewPatron.php" method="post">
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
    
    
    <input type="text" id="nameSearch" class="search_box" onkeyup="Search()"/>

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
                 $dateExpire=idate('s',$row['expiryDate']);
                 $date=$expireDate=mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));
                 $dateCurrent=iDate('s',$date);
                        
                if($dateCurrent>$dateExpire){
                    $maxFineNum=mysql_query("SELECT MAX(fineNo) FROM Fine");
                    $maxFineNum++;
                    $accountNo=$row['pAccount'];
                    $itemCode=$row['libraryCode'];
                    mysql_query("INSERT INFO Fines (fineNo, pAccount, libraryCode, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','Hold','$date')");
                }}
                //checks for overdue loans
                $loanDates=mysql_query("Select dateLoaned, pAccount, libraryCode, stockNum FROM Loan");
                while($row=mysql_fetch_array($loanDates)){
                 $dateExpire=idate('s',$row['dateLoaned']);
                 $date=$expireDate=mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));
                 $dateCurrent=iDate('s',$date);
                        
                if($dateCurrent>$dateExpire){
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
                     $dateE=$row['membershipExpiryDate'];
                    $dateEx=strtotime($dateE);
                    $dateExpire=idate('s', $dateEx);
                    $date=$expireDate=mktime(0, 0, 0, date("m"),   date("d"),   date("Y"));
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
                    echo "<td><a href='PatronInformation.php'><button id=".$row['pAccount']." value=".$row['pAccount']." onclick='setCookie()' name='button'>View</button></a></td>";
                    echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
</div>
</body>
