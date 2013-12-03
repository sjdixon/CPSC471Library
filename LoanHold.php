<!done by Rhianne>
<script>
$(function() {
var itemCodes = [];
var patrons = [];

var normalize = function( term ) {
var ret = "";
for ( var i = 0; i < term.length; i++ ) {
ret +=term.charAt(i);
}
return ret;
};
$( "#itemCode" ).autocomplete({
source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
response( $.grep( itemCodes, function( value ) {
value = value.label || value.value || value;
return matcher.test( value ) || matcher.test( normalize( value ) );
}) );
}
});

$( "#accountNo" ).autocomplete({
source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
response( $.grep( patrons, function( value ) {
value = value.label || value.value || value;
return matcher.test( value ) || matcher.test( normalize( value ) );
}) );
}
});
});

 $(function() {
$( "#datepicker" ).datepicker();
$( "#datepicker" ).datepicker( "option", "slideDown", $( this ).val() );
});

//place holder fof the place button
 $(function() {

});
//Function for the two loan and hold buttons buttons 
$(function() {
$( "#radio" ).buttonset();
});

//
 $(function() {
$( "#loan_hold_place" ).dialog({
autoOpen: false,
height: 300,
width: 350,
modal: true,
buttons: {
"loan_hold_place": function() {
$( this ).dialog( "close" );
}
},
close: function() {
allFields.val( "" ).removeClass( "ui-state-error" );
}
});
$( "#place" )
.button()
.click(function() {
$( "#place" ).dialog( "open" );
});
});
</script>
</head>
<body>
<!item code>
<div class="ui-widget">
<form>
<label for="itemCode">Library Item Code: </label>
<input id="itemCode">
</form>
</div>
 <br/>
 <div id="date">
 <!Date(datePicker)>
 <form>
    <label for="date">Date: </label>
  <input type="text" id="datepicker">
  </form>
  </div>
  <br/>
 <!Account number>
 <div class="ui-widget">
<form>
<label for="accountNo">Library Account Number: </label>
<input id="accountNo">
</form>
</div>
    
<!loan and hold buttons>
<form>
<div id="radio">
    <input type="radio" id="loan" name="radio"><label for="loan">Loan</label>
    <input type="radio" id="hold" name="radio"><label for="hold">Hold</label>
</div>
    
<div id="place">
    <button id="place">Place Loan or Hold</button>
</div
</form>

<div id="Loan_hold_place">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Your Loan/hold has been placed</p>
</div>    
<div>

</body>
</html>