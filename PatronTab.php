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
<script> 
//This Function fills the table with entrys when the tab is opened
$(function(){
   
    <?php
        // Create connection
        $con=mysql_connect();

        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
        $t=time();
        $date=date_create(date("y-m-d", $t));
        $holdDates=mysqli_query($con, "Select expiryDate, pAccount, libraryCode FROM HOLD");
        while($row=mysqli_fetch_array($holdDates)){
        $diff=date_diff($date,$row['expiryDate']);
        $timeDiff=$diff->format(a);
        if($timeDiff>0){
            $maxFineNum=mysqli_query($con, "SELECT MAX(fineNo) FROM Fine");
            $maxFineNum++;
            $accountNo=$row['pAccount'];
            $itemCode=$row['libraryCode'];
            mysqli_query($con, "INSERT INFO Fines (fineNo, pAccount, libraryCode, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','Hold','$date')");
        }}
        //checks for overdue loans
        $loanDates=mysqli_query($con, "Select dateLoaned, pAccount, libraryCode, stockNum FROM Loan");
        while($row=mysqli_fetch_array($loanDates)){
        $diff=date_diff($date,$row['dateLoaned']);
        $timeDiff=$diff->format(a);
        if($timeDiff>0){
            $maxFineNum=mysqli_query($con, "SELECT MAX(fineNo) FROM Fine");
            $maxFineNum++;
            $accountNo=$row['pAccount'];
            $itemCode=$row['libraryCode'];
            $instance=$row['stockNum'];
            mysqli_query($con, "INSERT INFO Fines (fineNo, pAccount, libraryCode, stockNum, reason, dateFined) VALUES ('$maxFineNum','$accountNo','$itemCode','$instance','Loan','$date')");
        }
        }
        //Checks for expired Cards
        $false=FALSE;
        $true=TRUE;
        $expiredCards=mysqli_query($con, "SELECT membershipExpiryDate, pAccount FROM Patron WHERE membershipExpired='$false'");
        while($row=mysqli_fetch_array($expiredCards)){
            $diff=date_diff($date,$row['membershipExpiryDate']);
            $timeDiff=$diff->format(a);    
            if($timeDiff>0){
                 $accountNo=$row['pAccount'];
                 mysqli_query($con, "UPDATE Patron SET membershipExpired=$true WHERE pAccount='$accountNo'");
            }
        }

        $fill=mysqli_query($con, "SELECT pAccount, name, membershipExpired FROM Patron");
        //Creates three arrays to store the account number, Patron name and the status of a patrons membership
        $pAccount[]=array(); 
        $name[]=array();
        $membershipExpired[]=array();
        $i=0;
        while($row=mysqli_fetch_array($fill))
        {
            $pAccount[$i]=$row['pAccount'];
            $name[$i]=$row['name'];
            $membershipExpired[$i]=$row['membershipExpired'];
        }
    ?>
            
    $( "#users tbody" ).empty();
    var num=$i;
    $i=0;
    while($i!==num)
    {
   $( "#users tbody" ).append( '<tr>' +
        '<td>' + '<div id="selected"><input type="checkbox" name="selectedValues[]" id="check" value=id.val()></div>'+'</td>' + 
        '<td>' + <?echo "$pAccount[i]"?> + '</td>' +
        '<td>' + <?echo "$name[i]"?> + '</td>' +
        '<td>' + <?echo "$membershipExpired[i]"?> + '</td>' + 
        '<td>'+'<a href="PatronInformation.php"><button>View</button></a>'+'</td>'+
        '</tr>' );
        $i++;
    }
    });
 //add  new patron           
$(function() {
var id=$("#id"), 
name = $( "#name" ),
email = $( "#email" ),
address = $( "#address"),
phone=$("#phone");

$( "#dialog-form" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"Create an account": function() {
<?php 
$unique =  mysqli_query($con, "SELECT * FROM PATRON WHERE pAccount='$_POST[id]'");
        
 $countKeys=0;
 while ($unique = mysql_fetch_assoc($unique)){ $countKeys++;}
?>
var keys="<?php echo $countKeys?>";
$valid=(keys===0 && email.val()!==NULL && name.val()!==NULL && address.val()!==NULL && phone.val()!==NULL);
if($valid===TRUE){
    <?php 
    //Creates the expire date
    $t=time();
    $date=date_create(date("y-m-d", $t));
    $ExpireDate=date_add($date,date_interval_create_from_date_string("1 year"));
    $false=FALSE;
    mysqli_query($con, "INSERT INTO Patron(pAccount, membershipExpiyDate, name,address, phone, email, memberShipExpired)
        VALUES ('$_POST[id]',$ExpireDate, '$_POST[name]', '$_POST[address]', '$_POST[phone]', '$_POST[email]', '$false' )");
    ?>

    $( "#users tbody").append('tr'+
            '<td>'+'<div id="selected"><input type="checkbox" name="selectedValues[]" id="check" value=id.val()></div>'+'</td>'+
            '<td>'+id.val()+'</td>'+
            '<td>'+name.val()+'</td>'+
            '<td>'+'False'+
            '</td>'+'<td>'+'<a href="PatronInformation.php"><button>View</button></a>'+'</td>'+
            '</tr>');

    $( this ).dialog( "close" );
}
else{<?php echo "The id you have entered is already in the database, Please enter a new Key";?>}
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
"Delete Patron(s)": function() {
<?php
if (isset($_POST['selectedValues'])) {
    $optionArray = $_POST['selectedValues'];
    for ($i=0; $i<count($optionArray); $i++) {
        mysqli_query($con, "DELETE FROM Patrons WHERE pAccount=$optionArray[$i]");
    }
}

?>
$( "#users tbody").empty();
 <?php
    $pAccount2[]=array(); 
    $name2[]=array();
    $membershipExpired2[]=array();
    $results=mysqli_query($con, "SELECT pAccount, name, membershipExpired FROM Patron");
    $i=0;
    while($row=mysqli_fetch_array($results))
    {
        $pAccount[i]=$row['pAccount'];
        $name[i]=$row['name'];
        $membershipExpired[i]=$row['membershipExpired'];
         $i++;
    }
    
    ?>

    var num=<?php echo $i?>;
    $i=0;
     $( "#users tbody" ).empty();
    while($i!==num)
    {
   
   $( "#users tbody" ).append( '<tr>' +
        '<td>' + '<div id="selected"><input type="checkbox" name="selectedValues[]" id="check" value=id.val()></div>'+'</td>' + 
        '<td>' + <?echo "$pAccount2[i]"?> + '</td>' +
        '<td>' + <?echo "$name2[i]"?> + '</td>' +
        '<td>' + <?echo "$membershipExpired2[i]"?> + '</td>' + 
        '<td>'+'<a href="PatronInformation.php"><button>View</button></a>'+'</td>'+
        '</tr>' );
        $i++;
    }
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
    <?php
    $pAccount1[]=array();
    $name1[]=array();
    $membershipExpired1[]=array();
    $searchResults=  mysqli_query($con, "SELECT pAccount, Name, isExpired FROM Patron WHERE pAccount='$_POST[inlineSearch]' OR name='$_POST[inlineSearch]]'");
    $i=0;
    while($row=mysqli_fetch_array($searchResults))
    {
        $pAccount1[i]=$row['pAccount'];
        $name1[i]=$row['name'];
        $membershipExpired1[i]=$row['membershipExpired'];
        $i++;
    }
    
    ?>
    
    $num=<?php echo $i?>;
    $i=0;
    while($i!==$num)
    
    $( "#users tbody" ).empty();
    $( "#users tbody" ).append( '<tr>' +
        '<td>' + '<div id="selected"><input type="checkbox" name="selectedValues[]" id="check" value=id.val()></div>'+'</td>' + 
        '<td>' + <?echo $pAccount1[i]?> + '</td>' +
        '<td>' + <?echo $name1[i]?> + '</td>' +
        '<td>' + <?echo $membershipExpired1[i]?> + '</td>' + 
        '<td>'+'<a href="PatronInformation.php"><button>View</button></a>'+'</td>'+
        '</tr>' );
        $i++;
}
</script>
</head>
<body>
    
<div id="dialog-confirm" title="Delete Patrons">
<p>These Patrons will be permanently deleted. Are you sure?</p>
</div>

<div id="dialog-form" title="Add a New Patron">
<form>
<fieldset>
<label for="id">Account Number</label>
<input type="number" name="id" id="id" class="text ui-widget-content ui-corner-all">
<label for="name">Name</label>
<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
<label for="email">Email</label>
<input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
<label for="address">Address</label>
<input type="text" name="address" id="address" value="" class="text ui-widget-content ui-corner-all">
<label for="phone">Phone</label>
<input type="text" name="phone" id="phone" class="text ui-widget-content ui-corner-all">
</fieldset>
</form>
</div>

<div>
    <input type="text" name="inlineSearch" id="iSearch" value="" class="text ui-widget-content ui-corner-all">
    <input type="submit" onclick="Search()">Search</button>
    <button id="add">Add new Patron</button>
    <button id="remove">Remove</button>
</div>
<div id="users-contain" class="ui-widget">
<!This is the table that stores the values provided by the php above>
<h1></h1>
<table id="users" class="ui-widget ui-widget-content">
<thead>
<tr class="ui-widget-header ">
<th></th>
<th>AccountNo</th>
<th>Name</th>
<th>Expires</th>
<th>User Profile</th>
</tr>
</thead>
<tbody>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</tbody>
</table>
</div>
</body>
</html>