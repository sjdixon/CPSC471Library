<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Book a Book - Patron </title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">

<style>
body { font-size: 62.5%; }
label, input { display:block; }
input.text { margin-bottom:12px; width:30%; padding: .4em; }
fieldset { padding:0; border:0; margin-top:25px; }
h1 { font-size: 1.2em; margin: .6em 0; }
div#users-contain { width: 350px; margin: 20px 0; }
div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
.ui-dialog .ui-state-error { padding: .3em; }
.validateTips { border: 1px solid transparent; padding: 0.3em; }

 #selected { margin-top: 2em; }
</style>

 <script>
$(function() {
$( "#selected" ).buttonset();
});
</script>

</head>
<body>

<div id="selected">
<input type="checkbox" id="check1">
</div>

<div>
    <input type="text" name="inlineSeact" id="iSearch" value="" class="text ui-widget-content ui-corner-all">
    <Button id="filter" title="Search">Search</button>
    <button id="add" tilte="Add">Add</button>
    <button id="Remove" tilte="Remove">Remove</button>
</div>
<div id="users-contain" class="ui-widget">
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
<td><div id="selected">
     <input type="checkbox" id="check1">
    </div>
</td>
<td>""</td>
<td>""</td>
<td>""</td>
<td>
    <a href="PatronInformation.php"><button>View</button></a>
</td>
</tr>
</tbody>
</table>
</div>
</body>
</html>