<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Book a Book Catalogue</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<style>
    
.custom-combobox {
position: relative;
display: inline-block;
}
.custom-combobox-toggle {
position: absolute;
top: 0;
bottom: 0;
margin-left: -1px;
padding: 0;
/* support: IE7 */
*height: 1.7em;
*top: 0.1em;
}
.custom-combobox-input {
margin: 0;
padding: 0.3em;
}
#parent {
width: 60%;
height: 40%;
margin: 10px auto;
padding: 5px;
border: 1px solid #777;
background-color: #fbca93;
text-align: center;
}
.positionable {
position: absolute;
display: block;
right: 0;
bottom: 0;
background-color: #bcd5e6;
text-align: center;
}
select, input {
margin-left: 15px;
}
</style>
<script>
(function( $ ) {
$.widget( "custom.combobox","custom.combobox2", {
_create: function() {
this.wrapper = $( "<span>" )
.addClass( "custom-combobox" )
.insertAfter( this.element );
this.element.hide();
this._createAutocomplete();
this._createShowAllButton();
},
_createAutocomplete: function() {
var selected = this.element.children( ":selected" ),
value = selected.val() ? selected.text() : "";
this.input = $( "<input>" )
.appendTo( this.wrapper )
.val( value )
.attr( "title", "" )
.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
.autocomplete({
delay: 0,
minLength: 0,
source: $.proxy( this, "_source" )
})
.tooltip({
tooltipClass: "ui-state-highlight"
});
this._on( this.input, {
autocompleteselect: function( event, ui ) {
ui.item.option.selected = true;
this._trigger( "select", event, {
item: ui.item.option
});
},
autocompletechange: "_removeIfInvalid"
});
},
_createShowAllButton: function() {
var input = this.input,
wasOpen = false;
$( "<a>" )
.attr( "tabIndex", -1 )
.attr( "title", "Show All Items" )
.tooltip()
.appendTo( this.wrapper )
.button({
icons: {
primary: "ui-icon-triangle-1-s"
},
text: false
})
.removeClass( "ui-corner-all" )
.addClass( "custom-combobox-toggle ui-corner-right" )
.mousedown(function() {
wasOpen = input.autocomplete( "widget" ).is( ":visible" );
})
.click(function() {
input.focus();
// Close if already visible
if ( wasOpen ) {
return;
}
// Pass empty string as value to search for, displaying all results
input.autocomplete( "search", "" );
});
},
_source: function( request, response ) {
var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
response( this.element.children( "option" ).map(function() {
var text = $( this ).text();
if ( this.value && ( !request.term || matcher.test(text) ) )
return {
label: text,
value: text,
option: this
};
}) );
},
_removeIfInvalid: function( event, ui ) {
// Selected an item, nothing to do
if ( ui.item ) {
return;
}
// Search for a match (case-insensitive)
var value = this.input.val(),
valueLowerCase = value.toLowerCase(),
valid = false;
this.element.children( "option" ).each(function() {
if ( $( this ).text().toLowerCase() === valueLowerCase ) {
this.selected = valid = true;
return false;
}
});
// Found a match, nothing to do
if ( valid ) {
return;
}
// Remove invalid value
this.input
.val( "" )
.attr( "title", value + " didn't match any item" )
.tooltip( "open" );
this.element.val( "" );
this._delay(function() {
this.input.tooltip( "close" ).attr( "title", "" );
}, 2500 );
this.input.data( "ui-autocomplete" ).term = "";
},
_destroy: function() {
this.wrapper.remove();
this.element.show();
}
});
})( jQuery );
$(function() {
$( "#combobox" ).combobox();
$( "#combobox2" ).combobox();
});    
    
$(function() {
function position() {

$( "#parent" ).position({
});
}
})

$(function() {
        $( "input[type=submit], a, button" )
        .button()
        .click(function( event ) {
        event.preventDefault();
        });
        });
</script>
</head>
<body>
    <a Href=" " <label> Login </label> </a>  
<div id="parent">
<p>
Catalogue
<br />
<select id="combobox">
<option value="">Select one...</option>
<option value="ActionScript">ActionScript</option>
<option value="AppleScript">AppleScript</option>
<option value="Asp">Asp</option>
<option value="BASIC">BASIC</option>
<option value="C">C</option>
</select>
<input id="Search" value=""/>
<select id="combobox">
<option value1="">Select one...</option>
<option value1="ActionScript">ActionScript</option>
<option value1="AppleScript">AppleScript</option>
<option value1="Asp">Asp</option>
<option value1="BASIC">BASIC</option>
<option value1="C">C</option>
</select>
<input type="submit"  value="Search" />
</p>

</div>
</body>
</html>